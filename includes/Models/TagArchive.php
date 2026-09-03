<?php
/**
 * Tag Archive Model
 *
 * Custom Timber model for post tag archives.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\Term;
use WPCinquanteEtUn\Traits\ArchivePost;

/**
 * TagArchive
 */
class TagArchive extends Term {
	use ArchivePost;

	/**
	 * Category filter links for the archive header.
	 *
	 * On tag archives, no category is active so "All" is not highlighted.
	 *
	 * @return array<int, array{title: string, url: string, active: bool}>
	 */
	public function filters(): array {
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$posts_url     = $posts_page_id ? (string) get_permalink( $posts_page_id ) : (string) get_post_type_archive_link( 'post' );
		$items         = array(
			array(
				'title'  => __( 'All', 'wp-cinquante-et-un' ),
				'url'    => $posts_url,
				'active' => false,
			),
		);

		foreach ( $this->categories() as $category ) {
			$items[] = array(
				'title'  => (string) $category->name,
				'url'    => (string) $category->link,
				'active' => false,
			);
		}

		return $items;
	}
}
