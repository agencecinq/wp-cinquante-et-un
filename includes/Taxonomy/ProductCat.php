<?php
/**
 * Product Category taxonomy
 *
 * @package Nexiode
 * @subpackage Nexiode/Taxonomy
 */

namespace Nexiode\Taxonomy;

use Nexiode\Service;

/**
 * ProductCat
 *
 * Registers the Product Category taxonomy for the Product post type.
 * Use ProductCat::TAXONOMY when querying or referencing the taxonomy slug.
 */
class ProductCat implements Service {

	/**
	 * Taxonomy slug.
	 *
	 * @var string
	 */
	public const TAXONOMY = 'product_cat';

	/**
	 * Post type(s) the taxonomy is registered to.
	 *
	 * @var string[]
	 */
	public const POST_TYPES = array( 'product' );

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'init', array( $this, 'register' ), 10 );
	}

	/**
	 * Register the product category taxonomy.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
	 *
	 * @return void
	 */
	public function register(): void {
		$labels = array(
			'name'                  => _x( 'Categories', 'Product category taxonomy: general name', 'nexiode' ),
			'singular_name'         => _x( 'Category', 'Product category taxonomy: singular name', 'nexiode' ),
			'search_items'          => __( 'Search Categories', 'nexiode' ),
			'all_items'             => __( 'All Categories', 'nexiode' ),
			'parent_item'           => __( 'Parent Category', 'nexiode' ),
			'parent_item_colon'     => __( 'Parent Category:', 'nexiode' ),
			'edit_item'             => __( 'Edit Category', 'nexiode' ),
			'view_item'             => __( 'View Category', 'nexiode' ),
			'update_item'           => __( 'Update Category', 'nexiode' ),
			'add_new_item'          => __( 'Add New Category', 'nexiode' ),
			'new_item_name'         => __( 'New Category Name', 'nexiode' ),
			'not_found'             => __( 'No categories found.', 'nexiode' ),
			'no_terms'              => __( 'No categories', 'nexiode' ),
			'items_list_navigation' => __( 'Categories list navigation', 'nexiode' ),
			'items_list'            => __( 'Categories list', 'nexiode' ),
			'back_to_items'         => __( '&larr; Back to Categories', 'nexiode' ),
		);

		$args = array(
			'labels'             => $labels,
			'hierarchical'       => false,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		);

		register_taxonomy( self::TAXONOMY, self::POST_TYPES, $args );
	}
}
