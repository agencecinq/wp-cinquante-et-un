<?php
/**
 * SavePost Class
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Plugins/ACF
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Plugins\ACF;

/**
 * SavePost Class
 */
class SavePost {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_filter( 'acf/save_post', array( $this, 'save_post' ), 10, 1 );
	}


	/**
	 * Handles the saving of a post using its ID.
	 *
	 * This method is triggered when a post is saved. It receives the post ID,
	 * which can be either an integer or a string, and performs necessary actions
	 * related to saving the post.
	 *
	 * @param int|string $post_id The ID of the post being saved.
	 */
	public function save_post( int|string $post_id ) {
	}
}
