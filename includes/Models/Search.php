<?php
/**
 * Search view model.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

/**
 * Search
 */
class Search {

	/**
	 * Suggested pages for empty search results.
	 *
	 * @param int $limit Number of pages to return.
	 * @return array<int, array<string, string>>
	 */
	public static function suggested_pages( int $limit = 4 ): array {
		$exclude = array_filter(
			array(
				(int) get_option( 'page_on_front' ),
				(int) get_option( 'page_for_posts' ),
			)
		);

		$pages = get_pages(
			array(
				'sort_column' => 'menu_order',
				'sort_order'  => 'ASC',
				'number'      => $limit,
				'exclude'     => $exclude,
			)
		);

		if ( empty( $pages ) ) {
			return array();
		}

		$items = array();

		foreach ( $pages as $page ) {
			$items[] = array(
				'title' => get_the_title( $page ),
				'url'   => (string) get_permalink( $page ),
			);
		}

		return $items;
	}
}
