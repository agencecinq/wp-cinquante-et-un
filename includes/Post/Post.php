<?php
/**
 * Post
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Post
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Post;

use WPCinquanteEtUn\Service;

/**
 * Post
 */
class Post implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'init', array( $this, 'add_post_type_supports' ) );
		add_action( 'pre_get_posts', array( $this, 'set_archive_posts_per_page' ) );
		add_filter( 'the_content', array( $this, 'add_heading_ids' ), 12 );
	}

	/**
	 * Adds post type supports.
	 *
	 * @return void
	 */
	public function add_post_type_supports(): void {
		add_post_type_support( 'page', 'excerpt' );
	}

	/**
	 * Two rows of three cards on the posts index and category archives.
	 *
	 * @param \WP_Query $query Main query.
	 * @return void
	 */
	public function set_archive_posts_per_page( \WP_Query $query ): void {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( $query->is_home() || $query->is_category() || $query->is_tag() ) {
			$query->set( 'posts_per_page', 6 );
		}
	}

	/**
	 * Add heading ids on single posts so the table of contents can link to H2s.
	 *
	 * @param string $content Post content.
	 * @return string
	 */
	public function add_heading_ids( string $content ): string {
		if ( is_admin() || ! is_singular( 'post' ) ) {
			return $content;
		}

		return cinq_add_heading_ids( $content );
	}
}
