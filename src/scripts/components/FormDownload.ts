import { Piece } from 'piecesjs';

class FormDownload extends Piece {
	constructor() {
		super('FormDownload');
	}

	mount() {
		this.on('wpcf7mailsent', document, this.handleSubmit);
	}

	private handleSubmit = (event: Event) => {
		const target = (event as CustomEvent).target;

		if (!(target instanceof HTMLElement)) {
			return;
		}

		const form = target.closest('form');

		if (!form || !this.contains(form)) {
			return;
		}

		const url =
			this.getAttribute('data-download-url') ||
			form.dataset.downloadUrl ||
			'';

		if (!url) {
			return;
		}

		const link = document.createElement('a');
		link.href = url;
		link.download = '';
		link.setAttribute('rel', 'noopener noreferrer');
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	};
}

customElements.define('cinq-form-download', FormDownload);
