import { Piece } from 'piecesjs';
import type { Map as LMap, Marker } from 'leaflet';

const pinIconUrl = new URL('../../img/svg/pin.svg', import.meta.url).href;
const PIN_SIZE: [number, number] = [24, 36];
const PIN_ANCHOR: [number, number] = [12, 36];

/** Map tile layer presets are now chosen purely from language. */

export interface StoreLocatorItem {
	name: string;
	address: string;
	phone: string;
	email: string;
	lat: string;
	lng: string;
}

/**
 * Generic store locator: search input filters a list and map markers from JSON data.
 * Data is provided via a <script type="application/json" data-dom="data">.
 */
class StoreLocator extends Piece {
	private items: StoreLocatorItem[] = [];
	private markers: Marker[] = [];
	private map: LMap | null = null;
	private L: typeof import('leaflet') | null = null;
	private defaultCenter: [number, number] = [46.8, 2.3];
	private defaultZoom = 6;

	private currentQuery = '';
	private $listItems: HTMLElement[] = [];
	private $empty: HTMLElement | null = null;

	constructor() {
		super('StoreLocator');
	}

	mount(): void {
		const $data = this.domAttr('data') as HTMLScriptElement | null;
		if (!$data?.textContent) return;

		try {
			const raw = JSON.parse($data.textContent) as Array<Record<string, unknown>>;
			this.items = raw.map((item) => this.normalizeItem(item));
		} catch {
			return;
		}

		this.$listItems = Array.from(this.domAttrAll('list-item')) as HTMLElement[];
		this.$empty = this.domAttr('empty') as HTMLElement | null;

		this.on('search:change', this, (event: Event) => {
			const { query } = (event as CustomEvent<{ query: string }>).detail;
			this.handleSearch(query);
		});
		this.initMap();
		this.handleSearch('');
	}

	private normalizeItem(item: Record<string, unknown>): StoreLocatorItem {
		const coords = (item.coordinates as Record<string, string>) || {};
		return {
			name: String(item.name ?? ''),
			address: String(item.address ?? ''),
			phone: String(item.phone ?? ''),
			email: String(item.email ?? ''),
			lat: String(coords.latitude ?? coords.lat ?? ''),
			lng: String(coords.longitude ?? coords.lng ?? ''),
		};
	}

	private itemMatches(item: StoreLocatorItem, query: string): boolean {
		if (!query) return true;
		const text = `${item.name} ${item.address}`.toLowerCase();
		return text.includes(query);
	}

	private handleSearch = (rawQuery: string): void => {
		this.currentQuery = rawQuery.trim().toLowerCase();

		let anyVisible = false;

		this.$listItems.forEach(($el, index) => {
			const item = this.items[index];
			const visible = item ? this.itemMatches(item, this.currentQuery) : false;
			$el.style.display = visible ? '' : 'none';
			$el.setAttribute('aria-hidden', visible ? 'false' : 'true');
			if (visible) {
				anyVisible = true;
			}
		});

		if (this.$empty) {
			if (anyVisible) {
				this.$empty.hidden = true;
				this.$empty.setAttribute('aria-hidden', 'true');
			} else {
				this.$empty.hidden = false;
				this.$empty.setAttribute('aria-hidden', 'false');
			}
		}

		this.updateMapMarkers(this.currentQuery);
	};

	private initMap(): void {
		const $mapEl = this.domAttr('map') as HTMLElement | null;
		if (!$mapEl || this.items.length === 0) return;

		// @ts-expect-error Leaflet CSS has no type declarations
		import('leaflet/dist/leaflet.css');
		import('leaflet').then((L) => {
			this.L = L.default;
			$mapEl.innerHTML = '';
			this.map = this.L.map($mapEl, {
				center: this.defaultCenter,
				zoom: this.defaultZoom,
				attributionControl: false,
			});

			const langRaw = (this.getAttribute('data-lang') || document.documentElement.lang || 'en').toLowerCase();
			const lang = langRaw.split(/[-_]/)[0] || 'en';

			const isFrench = lang === 'fr';

			const tileUrl = isFrench
				? 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'
				: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

			const attribution = '';

			this.L!.tileLayer(tileUrl, { attribution }).addTo(this.map);

			const pinIcon = this.L.icon({
				iconUrl: pinIconUrl,
				iconSize: PIN_SIZE,
				iconAnchor: PIN_ANCHOR,
			});

			this.markers = [];
			this.items.forEach((item, i) => {
				const lat = parseFloat(item.lat);
				const lng = parseFloat(item.lng);
				if (Number.isFinite(lat) && Number.isFinite(lng)) {
					const marker = this.L!.marker([lat, lng], { icon: pinIcon }).addTo(this.map!);
					this.markers[i] = marker;
				}
			});
			this.updateMapMarkers(this.currentQuery);
		});
	}

	private updateMapMarkers(query: string): void {
		if (!this.map || !this.L) return;
		const visibleLatLngs: [number, number][] = [];
		this.items.forEach((item, i) => {
			const marker = this.markers[i];
			if (!marker) return;
			const visible = this.itemMatches(item, query);
			marker.setOpacity(visible ? 1 : 0.2);
			if (visible) {
				const lat = parseFloat(item.lat);
				const lng = parseFloat(item.lng);
				if (Number.isFinite(lat) && Number.isFinite(lng)) {
					visibleLatLngs.push([lat, lng]);
				}
			}
		});
		if (visibleLatLngs.length === 1) {
			this.map.setView(visibleLatLngs[0], 14);
		} else if (visibleLatLngs.length > 1) {
			const bounds = this.L.latLngBounds(visibleLatLngs);
			this.map.fitBounds(bounds, { padding: [24, 24], maxZoom: 14 });
		} else {
			this.map.setView(this.defaultCenter, this.defaultZoom);
		}
	}
}

customElements.define("cinq-store-locator", StoreLocator);
