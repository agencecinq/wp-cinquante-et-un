<?php
/**
 * Loader
 *
 * Handles loading and redirecting template-related functionality.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Template
 * @see https://developer.wordpress.org/reference/hooks/template_redirect/
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Template;

use WPCinquanteEtUn\Service;

/**
 * Handles loading and redirecting template-related functionality.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn
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
	 * Redirects orphaned search queries to the native home search URL.
	 *
	 * WordPress 404s when `?s=` is appended to a page permalink (e.g. /recherche/?s=foo).
	 *
	 * @return void
	 */
	public function template_redirect(): void {
		$search_query = get_search_query();

		if ( '' === $search_query || is_search() ) {
			return;
		}

		wp_safe_redirect(
			add_query_arg(
				's',
				$search_query,
				home_url( '/' )
			)
		);
		exit;
	}
}
