<?php
/**
 * Post States
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Template
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Template;

use WP_Post;

/**
 * PostStates
 *
 * Adds a custom post state to the post/page edit screen.
 *
 * @package WPCinquanteEtUn
 */
class PostStates {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() : void {
		add_filter( 'display_post_states', array( $this, 'filter_post_states' ), 10, 2 );
	}

	/**
	 * Post states
	 *
	 * Adds a custom post state to the post/page edit screen.
	 *
	 * @param string[] $post_states An array of post display states.
	 * @param WP_Post  $post        The current post object.
	 *
	 * @return array $states
	 */
	public function filter_post_states( array $post_states, WP_Post $post ) {
		if ( 'page-templates/thank-you-page.php' === get_post_meta( $post->ID, '_wp_page_template', true ) ) {
			$post_states[] = __( 'Thank You Page', 'wp-cinquante-et-un' );
		}

		if ( 'page-templates/contact-page.php' === get_post_meta( $post->ID, '_wp_page_template', true ) ) {
			$post_states[] = __( 'Contact Page', 'wp-cinquante-et-un' );
		}

		return $post_states;
	}
}
