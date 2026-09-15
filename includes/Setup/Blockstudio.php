<?php
/**
 * Blockstudio
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Setup
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Setup;

use Blockstudio\Block_Registry;
use WPCinquanteEtUn\Service;

/**
 * Blockstudio theme wiring for the feat/blockstudio pilot.
 *
 * Tailwind is enabled via blockstudio.json (frontend TailwindPHP + editor CDN).
 * Theme tokens are passed through the config filter; the CDN is forced because
 * pilot blocks hardcode utilities instead of a classes field with tailwind: true.
 *
 * @see https://blockstudio.dev/docs/tailwind/
 */
class Blockstudio implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'blockstudio/settings/tailwind/config', array( $this, 'tailwind_config' ) );
		add_action( 'blockstudio/init', array( $this, 'activate_editor_tailwind_cdn' ) );
		add_filter( 'block_editor_settings_all', array( $this, 'inject_accordion_editor_module' ), PHP_INT_MAX );
	}

	/**
	 * Load @agencecinq/accordion in the Gutenberg canvas iframe.
	 *
	 * Blockstudio inlines `*.js` as type=module in the editor, so relative
	 * imports resolve against the document URL and break. Inject an absolute
	 * module src instead. Frontend keeps using Vite (`src/scripts/app.js`).
	 *
	 * @param array<string, mixed> $settings Editor settings.
	 * @return array<string, mixed>
	 */
	public function inject_accordion_editor_module( array $settings ): array {
		if ( ! isset( $settings['__unstableResolvedAssets'] ) || ! is_array( $settings['__unstableResolvedAssets'] ) ) {
			return $settings;
		}

		$url = get_theme_file_uri( 'blockstudio/accordion-group/vendor/cinq-accordion.js' );

		$settings['__unstableResolvedAssets']['scripts'] = ( $settings['__unstableResolvedAssets']['scripts'] ?? '' )
			. sprintf(
				'<script type="module" src="%s"></script>',
				esc_url( $url )
			);

		return $settings;
	}

	/**
	 * Theme tokens and utilities shared with src/stylesheets.
	 *
	 * @param mixed $config Current config string.
	 * @return string
	 */
	public function tailwind_config( $config ): string {
		$base = is_string( $config ) ? $config : '';

		$theme = <<<'CSS'
@theme {
	--font-sans: ui-sans-serif, system-ui, sans-serif;
	--default-font-family: var(--font-sans);
	--color-ink: #2a343a;
	--color-background: var(--color-white);
	--color-foreground: var(--color-ink);
	--color-button: var(--color-ink);
	--color-button-text: var(--color-white);
	--color-secondary-button: var(--color-white);
	--color-secondary-button-text: var(--color-ink);
	--color-link: var(--color-ink);
	--container-max-width: 90rem;
	--max-width-prose: 45rem;
	--max-width-prose-wide: 60rem;
}

@layer base {
	[data-color-scheme="inverse"] {
		--color-background: var(--color-ink);
		--color-foreground: var(--color-white);
		--color-button: var(--color-white);
		--color-button-text: var(--color-ink);
		--color-secondary-button: var(--color-ink);
		--color-secondary-button-text: var(--color-white);
		--color-link: var(--color-white);
	}
}

@utility container {
	margin-inline: auto;
	width: 100%;
	padding-inline: calc(var(--spacing) * 5);
	max-width: var(--container-max-width);
}

@utility container-wide {
	margin-inline: auto;
	width: 100%;
	padding-inline: calc(var(--spacing) * 5);
	max-width: 110rem;
}

@utility subtitle {
	font-size: var(--text-xs);
	line-height: var(--text-xs--line-height);
	font-weight: var(--font-weight-medium);
	text-transform: uppercase;
	letter-spacing: 0.1em;
}

@utility pt-section-none { padding-top: 0; }
@utility pb-section-none { padding-bottom: 0; }
@utility pt-section-sm { padding-top: 1.5rem; }
@utility pb-section-sm { padding-bottom: 1.5rem; }
@utility pt-section-md { padding-top: 2.5rem; }
@utility pb-section-md { padding-bottom: 2.5rem; }
@utility pt-section-lg { padding-top: 3.5rem; }
@utility pb-section-lg { padding-bottom: 3.5rem; }
@utility pt-section-xl { padding-top: 4.5rem; }
@utility pb-section-xl { padding-bottom: 4.5rem; }

@layer components {
	.button {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: calc(var(--spacing) * 2);
		border-radius: 0;
		text-align: center;
		font-size: var(--text-xs);
		line-height: var(--text-xs--line-height);
		font-weight: var(--font-weight-medium);
		padding-block: calc(var(--spacing) * 3);
		padding-inline: calc(var(--spacing) * 4);
	}
	.button--primary {
		border-width: 1px;
		border-color: var(--color-button);
		background-color: var(--color-button);
		color: var(--color-button-text);
	}
	.button--secondary {
		border-width: 1px;
		background-color: transparent;
		border-color: var(--color-foreground);
		color: var(--color-foreground);
	}
}
CSS;

		return trim( $base . "\n" . $theme );
	}

	/**
	 * Load the editor Tailwind CDN even without a classes field (tailwind: true).
	 *
	 * Pilot blocks hardcode utilities in Twig; Blockstudio only auto-flags the CDN
	 * when a classes attribute opts into Tailwind.
	 *
	 * @return void
	 */
	public function activate_editor_tailwind_cdn(): void {
		if ( ! is_admin() || ! class_exists( Block_Registry::class ) ) {
			return;
		}

		Block_Registry::instance()->set_tailwind_active( true );
	}
}
