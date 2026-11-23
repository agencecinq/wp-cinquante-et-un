import { Piece } from "piecesjs";
import { getFocusableElements } from "@agencecinq/utils";

/**
 * Mobile menu, inside the non-modal menu drawer (a popover dialog).
 *
 * Switches between the main panel and a sub panel (open sub / back to main),
 * hidden with the `hidden` attribute so the hidden panel leaves the focus order.
 * While the drawer is open, the regions it covers are inert: a popover does not
 * contain focus, so Tab and screen readers would reach what the drawer hides.
 * Closing the drawer brings the main panel back.
 */
class MobileMenu extends Piece {
	#$dialog: HTMLDialogElement | null = null;

	/** Button that opened the current sub panel, focused again on back. */
	#$opener: HTMLButtonElement | null = null;

	constructor() {
		super("MobileMenu");
	}

	mount(): void {
		this.#$dialog = this.closest("dialog");

		this.on("click", this, this.#handleClick);
		this.#$dialog?.addEventListener("beforetoggle", this.#handleBeforeToggle);
		this.#$dialog?.addEventListener("toggle", this.#handleToggle);
	}

	unmount(): void {
		this.off("click", this, this.#handleClick);
		this.#$dialog?.removeEventListener("beforetoggle", this.#handleBeforeToggle);
		this.#$dialog?.removeEventListener("toggle", this.#handleToggle);
	}

	#handleClick = (event: Event): void => {
		const $target = event.target as HTMLElement;
		const $open = $target.closest<HTMLButtonElement>('[data-dom="open-sub"]');

		if ($open) {
			this.#showSub($open);
			return;
		}

		if ($target.closest('[data-dom="back-to-main"]')) {
			this.#showMain();
		}
	};

	/** Fires before focus returns to the burger, so an opener in a covered region gets it back. */
	#handleBeforeToggle = (event: Event): void => {
		const inert = (event as ToggleEvent).newState === "open";

		document.querySelectorAll<HTMLElement>("main, footer").forEach(($region) => {
			$region.inert = inert;
		});
	};

	#handleToggle = (event: Event): void => {
		if ((event as ToggleEvent).newState === "closed") {
			this.#showMain(false);
		}
	};

	#showSub($open: HTMLButtonElement): void {
		const $sub = this.querySelector<HTMLElement>(`#${$open.getAttribute("aria-controls")}`);

		if (!$sub) {
			return;
		}

		this.#$opener = $open;
		this.#setPanel($sub);

		const [$first] = getFocusableElements($sub);

		$first?.focus();
	}

	#showMain(focus = true): void {
		const $main = this.domAttr("main") as HTMLElement | null;

		if (!$main) {
			return;
		}

		this.#setPanel($main);

		if (focus) {
			this.#$opener?.focus();
		}

		this.#$opener = null;
	}

	/** Shows one panel, hides the others, and syncs `aria-expanded` on the sub panel openers. */
	#setPanel($panel: HTMLElement): void {
		this.querySelectorAll<HTMLElement>("[data-panel]").forEach(($element) => {
			$element.hidden = $element !== $panel;
		});

		this.querySelectorAll<HTMLButtonElement>('[data-dom="open-sub"]').forEach(($button) => {
			const expanded = $button.getAttribute("aria-controls") === $panel.id;

			$button.setAttribute("aria-expanded", expanded.toString());
		});
	}
}

customElements.define("cinq-mobile-menu", MobileMenu);
