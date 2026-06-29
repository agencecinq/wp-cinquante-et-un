import { Piece } from 'piecesjs';

class SearchInput extends Piece {
	private $input!: HTMLInputElement;

	constructor() {
		super('SearchInput');
	}

	mount() {
		this.$input = this.domAttr('input') as HTMLInputElement;
		const $submit = this.domAttr('submit') as HTMLButtonElement | null;

		const emit = () => {
			const root = (this.closest('cinq-store-locator') as HTMLElement | null) ?? this;

			this.emit('search:change', root, {
				query: (this.$input.value ?? '').trim(),
			});
		};

		this.on('input', this.$input, emit);
		this.on('change', this.$input, emit);
		if ($submit) {
			this.on('click', $submit, (e) => {
				e.preventDefault();
				emit();
			});
		}
	}
}

customElements.define('cinq-search-input', SearchInput);