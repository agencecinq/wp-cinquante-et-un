<?php
/**
 * Loader
 *
 * Handles loading and redirecting template-related functionality.
 *
 * @package Nexiode
 * @subpackage Nexiode/Template
 * @see https://developer.wordpress.org/reference/hooks/template_redirect/
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace Nexiode\Template;

use Nexiode\Service;

/**
 * Handles loading and redirecting template-related functionality.
 *
 * @package WordPress
 * @subpackage Nexiode
 */
class Loader implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
	}

	/**
	 * Redirect templates as needed.
	 *
	 * @return void
	 */
	public function template_redirect() {
	}
}
