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
	 * Estimated reading time in minutes (ACF value, else computed).
	 *
	 * @return int
	 */
	public function reading_time(): int {
		$stored = (int) $this->meta( 'reading_time' );

		if ( $stored > 0 ) {
			return $stored;
		}

		return cinq_estimate_reading_time( (string) $this->post_content );
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
