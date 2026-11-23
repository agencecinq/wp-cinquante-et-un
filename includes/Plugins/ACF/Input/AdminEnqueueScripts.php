<?php
/**
 * ACF Input admin enqueue scripts
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Plugins/ACF/Input
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Plugins\ACF\Input;

use WPCinquanteEtUn\Service;

/**
 * AdminEnqueueScripts
 *
 * @see https://www.advancedcustomfields.com/resources/acf-input-admin_enqueue_scripts/
 */
class AdminEnqueueScripts implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqueues ACF admin styles (color scheme and palette swatches).
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts(): void {
		$handle = get_theme_text_domain() . '-acf-swatches';

		wp_register_style( $handle, false, array(), wp_get_theme()->get( 'Version' ) );
		wp_enqueue_style( $handle );
		wp_add_inline_style( $handle, $this->swatches_css() );
	}

	/**
	 * Swatches on the `color_scheme` and palette `color` button groups:
	 * shape, then colors from includes/schemes.php.
	 *
	 * @return string CSS.
	 */
	private function swatches_css(): string {
		$labels = ".acf-field[data-name='color_scheme'] .acf-button-group label,.acf-field[data-name='color'][data-type='button_group'] .acf-button-group label";
		$css    = $labels . '{display:inline-flex;align-items:center;gap:.4em}'
			. str_replace( 'label', 'label::before', $labels )
			. "{content:'';width:1.25rem;height:1.25rem;flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;border:1px solid rgba(0,0,0,.2);box-sizing:border-box;font:700 .6875rem/1 ui-sans-serif,system-ui,sans-serif}"
			// Scheme swatch: an "A" in the scheme text color.
			. ".acf-field[data-name='color_scheme'] .acf-button-group label::before{content:'A' / ''}";

		foreach ( array_keys( cinq_schemes() ) as $slug ) {
			$css .= sprintf(
				".acf-field[data-name='color_scheme'] .acf-button-group label:has(input[value='%s'])::before{background:%s;color:%s}",
				$slug,
				cinq_scheme_color( $slug, 'background-color-page' ),
				cinq_scheme_color( $slug, 'text-color-primary' )
			);
		}

		foreach ( cinq_palette() as $slug => $color ) {
			$css .= sprintf(
				".acf-field[data-name='color'][data-type='button_group'] .acf-button-group label:has(input[value='%s'])::before{background:%s}",
				$slug,
				$color['value']
			);
		}

		return $css;
	}
}
