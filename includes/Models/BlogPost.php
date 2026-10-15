<?php
/**
 * Timber post model for the journal (post type post).
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\Post;
use Timber\Timber;
use WPCinquanteEtUn\Traits\ArchivePost;

/**
 * BlogPost
 *
 * Adds reading time and related posts for the single template.
 */
class BlogPost extends Post {
	use ArchivePost;

	/**
	 * Estimated reading time in minutes, from the cinq-wp-reading-time mu-plugin.
	 *
	 * @return int 0 when the plugin is missing or the content is empty.
	 */
	public function reading_time(): int {
		return function_exists( 'cinq_reading_time' ) ? cinq_reading_time( $this->ID ) : 0;
	}


	/**
	 * Table of contents tree from the cinq-wp-table-of-contents mu-plugin.
	 *
	 * Its the_content filter injects the heading ids the entries link to.
	 *
	 * @return array<int, array{title: string, id: string, level: int, children: array}>
	 */
	public function table_of_contents(): array {
		return function_exists( 'cinq_toc_items' ) ? cinq_toc_items( (string) $this->content ) : array();
	}


	/**
	 * Related posts from the ACF relationship, falling back to the latest posts.
	 *
	 * @return array<int, object>
	 */
	public function related_posts(): array {
		$ids = $this->meta( 'related' );

		if ( ! is_array( $ids ) ) {
			$ids = array();
		}

		$ids = array_filter( array_map( 'absint', $ids ) );

		if ( $ids ) {
			$posts = Timber::get_posts(
				array(
					'post_type'      => 'post',
					'post__in'       => $ids,
					'orderby'        => 'post__in',
					'posts_per_page' => count( $ids ),
				)
			);

			return $posts ? iterator_to_array( $posts, false ) : array();
		}

		$posts = Timber::get_posts(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => 3,
				'post__not_in'        => array( $this->id ),
				'ignore_sticky_posts' => true,
			)
		);

		return $posts ? iterator_to_array( $posts, false ) : array();
	}
}
