<?php
/**
 * ArchivePost Trait
 *
 * Shared archive helpers for the posts index and category archives.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Traits
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Traits;

use Timber\Timber;

/**
 * ArchivePost
 */
trait ArchivePost {

	/**
	 * Categories for archive filter chips.
	 *
	 * @return array<int, \Timber\Term>
	 */
	public function categories(): array {
		$terms = Timber::get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		);

		return is_array( $terms ) ? $terms : array();
	}

	/**
	 * Current category term ID when viewing a category archive.
	 *
	 * @return int|null
	 */
	public function active_category_id(): ?int {
		$object = get_queried_object();

		if ( ! $object instanceof \WP_Term || 'category' !== $object->taxonomy ) {
			return null;
		}

		return (int) $object->term_id;
	}

	/**
	 * Hero fields from the posts archive options page.
	 *
	 * @return array<string, mixed>|null
	 */
	public function hero(): ?array {
		$archive = get_field( 'archive_posts', 'option' );

		if ( ! is_array( $archive ) || empty( $archive['hero'] ) || ! is_array( $archive['hero'] ) ) {
			return null;
		}

		return $archive['hero'];
	}

	/**
	 * Blocks below the posts list from the archive options page.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function blocks(): array {
		$archive = get_field( 'archive_posts', 'option' );

		if ( ! is_array( $archive ) || empty( $archive['blocks'] ) || ! is_array( $archive['blocks'] ) ) {
			return array();
		}

		return $archive['blocks'];
	}


	/**
	 * Category filter links for the archive header.
	 *
	 * @return array<int, array{title: string, url: string, active: bool}>
	 */
	public function filter_items(): array {
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$posts_url     = $posts_page_id ? (string) get_permalink( $posts_page_id ) : (string) get_post_type_archive_link( 'post' );
		$active_id     = $this->active_category_id();
		$items         = array(
			array(
				'title'  => __( 'All', 'wp-cinquante-et-un' ),
				'url'    => $posts_url,
				'active' => null === $active_id,
			),
		);

		foreach ( $this->categories() as $category ) {
			$items[] = array(
				'title'  => (string) $category->name,
				'url'    => (string) $category->link,
				'active' => (int) $category->id === $active_id,
			);
		}

		return $items;
	}
}
