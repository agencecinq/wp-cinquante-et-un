import { Piece } from 'piecesjs';

/**
 * Builds a table of contents from H2 headings inside a content root.
 */
class Toc extends Piece {
	constructor() {
		super('Toc');
	}

	mount(): void {
		const source = this.getAttribute('source');

		if (!source) {
			return;
		}

		const $root = document.querySelector(source);
		const $panel = this.domAttr('panel') as HTMLElement | null;
		const $list = this.domAttr('list') as HTMLUListElement | null;

		if (!$root || !$panel || !$list) {
			return;
		}

		const headings = Array.from($root.querySelectorAll('h2'));

		if (!headings.length) {
			return;
		}

		headings.forEach((heading, index) => {
			if (!heading.id) {
				heading.id = `section-${index + 1}`;
			}

			const $item = document.createElement('li');
			const $link = document.createElement('a');

			$link.href = `#${heading.id}`;
			$link.textContent = heading.textContent?.trim() ?? '';
			$link.className = 'text-sm text-gray-500 hover:text-black';

			$item.appendChild($link);
			$list.appendChild($item);
		});

		$panel.classList.remove('hidden');
	}
}

customElements.define('cinq-toc', Toc);
