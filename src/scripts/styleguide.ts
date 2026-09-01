import '@agencecinq/combobox';
import '@agencecinq/disclosure-button';
import '@agencecinq/spinbutton';
import '@agencecinq/switch';
import '@agencecinq/tabs';

import type { Combobox } from '@agencecinq/combobox';

const cities = ['Paris', 'Tours', 'Marseille', 'Lyon', 'Nantes'];

function wireCombobox($combobox: Combobox) {
	$combobox.search = (value) => {
		if (value.length < 1) {
			return cities;
		}

		const query = value.toLowerCase();

		return cities.filter((name) => name.toLowerCase().startsWith(query));
	};

	const $button = $combobox.querySelector<HTMLButtonElement>('button[aria-controls]');

	if (!$button) {
		return;
	}

	const syncButton = () => {
		$button.setAttribute('aria-expanded', $combobox.expanded ? 'true' : 'false');
		$button.disabled = $combobox.disabled;
	};

	$button.addEventListener('mousedown', (event) => event.preventDefault());
	$button.addEventListener('click', (event) => {
		event.stopPropagation();

		if ($combobox.disabled) {
			return;
		}

		if ($combobox.expanded) {
			$combobox.hide({ force: true });
			return;
		}

		void $combobox.ensureOpen().then(() => $combobox.$input?.focus());
	});

	new MutationObserver(syncButton).observe($combobox, {
		attributes: true,
		attributeFilter: ['expanded', 'disabled'],
	});

	syncButton();
}

void customElements.whenDefined('cinq-combobox').then(() => {
	const $combobox = document.querySelector<Combobox>('#styleguide-city-combobox');

	if ($combobox) {
		wireCombobox($combobox);
	}
});
