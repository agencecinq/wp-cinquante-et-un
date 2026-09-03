<?php
/**
 * ACF load_field handlers for dynamic select choices.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF
 */

namespace WPCinquanteEtUn\Plugins\ACF;

use WPCinquanteEtUn\Service;

/**
 * LoadField
 */
class LoadField implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'acf/load_field/name=form_id', array( $this, 'load_form_id_field' ) );
	}

	/**
	 * Populates form_id select choices from Contact Form 7.
	 *
	 * @param array<string, mixed> $field ACF field array.
	 * @return array<string, mixed>
	 */
	public function load_form_id_field( array $field ): array {
		$field['choices'] = cinq_cf7_form_choices();

		return $field;
	}
}
