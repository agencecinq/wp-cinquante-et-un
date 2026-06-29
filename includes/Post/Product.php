<?php
/**
 * Class Product
 *
 * @package WordPress
 * @subpackage Enodis\Post
 */

namespace Nexiode\Post;

use Nexiode\Service;

/**
 * Product class
 */
class Product implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @access public
	 */
	public function run(): void {
		add_action( 'init', array( $this, 'register' ), 10, 0 );
		add_action( 'admin_head', array( $this, 'css' ) );
		add_action( 'manage_product_posts_custom_column', array( $this, 'render_custom_columns' ), 10, 2 );

		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ), 10, 1 );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
		add_filter( 'manage_product_posts_columns', array( $this, 'add_custom_columns' ) );
	}


	/**
	 * CSS
	 *
	 * @return bool
	 */
	public function css(): bool {
		global $typenow;

		if ( 'product' !== $typenow ) {
			return false;
		}

		?>
		<style>
			.fixed .column-thumbnail {
				vertical-align: top;
				width: 80px;
			}

			.fixed .column-product_type {
				width: 80px;
			}

			.column-thumbnail a {
				display: block;
			}
			.column-thumbnail a img {
				display: inline-block;
				vertical-align: middle;
				width: 80px;
				height: 80px;
				object-fit: contain;
				object-position: center;
				overflow: hidden;
			}
		</style>
		<?php

		return true;
	}


	/**
	 * Add custom columns
	 *
	 * @param array $columns Array of columns.
	 * @return array $new_columns
	 * @link https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
	 */
	public function add_custom_columns( array $columns ): array {
		$new_columns = array();

		unset( $columns['date'] );

		foreach ( $columns as $key => $value ) {
			if ( 'title' === $key ) {
				$new_columns['thumbnail'] = __( 'Thumbnail', 'nexiode' );
			}

			$new_columns[ $key ] = $value;
		}
		return $new_columns;
	}


	/**
	 * Render custom columns
	 *
	 * @param string $column_name The column name.
	 * @param int    $post_id The ID of the post.
	 * @link https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
	 *
	 * @return void
	 */
	public function render_custom_columns( string $column_name, int $post_id ): void {
		switch ( $column_name ) {
			case 'thumbnail':
				$color     = get_field( 'color', $post_id );
				$thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail' );
				$html      = '—';

				if ( $thumbnail ) {
					$html  = '<a href="' . esc_attr( get_edit_post_link( $post_id ) ) . '"';
					$html .= $color ? ' style="background-color: ' . $color . ';"' : '';
					$html .= '>';
					$html .= $thumbnail;
					$html .= '</a>';
				}

				echo wp_kses_post( $html );

				break;
		}
	}


	/**
	 * Updated messages
	 *
	 * @param array $messages Post updated messages. For defaults see $messages declarations above.
	 * @return array $message
	 * @link https://developer.wordpress.org/reference/hooks/post_updated_messages/
	 * @access public
	 */
	public function updated_messages( array $messages ): array {
		global $post;

		$post_ID     = isset( $post_ID ) ? (int) $post_ID : 0;
		$preview_url = get_preview_post_link( $post );

		/* translators: Publish box date format, see https://secure.php.net/date */
		$scheduled_date = date_i18n( __( 'M j, Y @ H:i', 'nexiode' ), strtotime( $post->post_date ) );

		$view_link_html = sprintf(
			' <a href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_ID ) ),
			__( 'View product', 'nexiode' )
		);

		$scheduled_link_html = sprintf(
			' <a target="_blank" href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_ID ) ),
			__( 'Preview product', 'nexiode' )
		);

		$preview_link_html = sprintf(
			' <a target="_blank" href="%1$s">%2$s</a>',
			esc_url( $preview_url ),
			__( 'Preview product', 'nexiode' )
		);

		$messages['product'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Product updated.', 'nexiode' ) . $view_link_html,
			2  => __( 'Custom field updated.', 'nexiode' ),
			3  => __( 'Custom field deleted.', 'nexiode' ),
			4  => __( 'Product updated.', 'nexiode' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Product restored to revision from %s.', 'nexiode' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore
			6  => __( 'Product published.', 'nexiode' ) . $view_link_html,
			7  => __( 'Product saved.', 'nexiode' ),
			8  => __( 'Product submitted.', 'nexiode' ) . $preview_link_html,
			9  => sprintf( __( 'Product scheduled for: %s.', 'nexiode' ), '<strong>' . $scheduled_date . '</strong>' ) . $scheduled_link_html, // phpcs:ignore
			10 => __( 'Product draft updated.', 'nexiode' ) . $preview_link_html,
		);

		return $messages;
	}


	/**
	 * Bulk updated messages
	 *
	 * @param array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
	 * @param array $bulk_counts Array of item counts for each message, used to build internationalized strings.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/bulk_post_updated_messages/
	 *
	 * @return array $bulk_counts
	 */
	public function bulk_updated_messages( array $bulk_messages, array $bulk_counts ): array {
		$bulk_messages['product'] = array(
			/* translators: %s: Number of products. */
			'updated'   => _n( '%s product updated.', '%s products updated.', $bulk_counts['updated'], 'nexiode' ),
			'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 product not updated, somebody is editing it.', 'nexiode' ) :
				/* translators: %s: Number of products. */
				_n( '%s product not updated, somebody is editing it.', '%s products not updated, somebody is editing them.', $bulk_counts['locked'], 'nexiode' ),
			/* translators: %s: Number of products. */
			'deleted'   => _n( '%s product permanently deleted.', '%s product permanently deleted.', $bulk_counts['deleted'], 'nexiode' ),
			/* translators: %s: Number of products.. */
			'trashed'   => _n( '%s product moved to the Trash.', '%s product moved to the Trash.', $bulk_counts['trashed'], 'nexiode' ),
			/* translators: %s: Number of products. */
			'untrashed' => _n( '%s product restored from the Trash.', '%s product restored from the Trash.', $bulk_counts['untrashed'], 'nexiode' ),
		);

		return $bulk_messages;
	}


	/**
	 * Register Custom Post Type
	 *
	 * @return void
	 * @access public
	 */
	public function register(): void {
		$labels = array(
			'name'                     => _x( 'Products', 'product type generale name', 'nexiode' ),
			'singular_name'            => _x( 'Product', 'product type singular name', 'nexiode' ),
			'add_new'                  => _x( 'Add New', 'product type', 'nexiode' ),
			'add_new_item'             => __( 'Add New Product', 'nexiode' ),
			'edit_item'                => __( 'Edit Product', 'nexiode' ),
			'new_item'                 => __( 'New Product', 'nexiode' ),
			'view_items'               => __( 'View Products', 'nexiode' ),
			'view_item'                => __( 'View Product', 'nexiode' ),
			'search_items'             => __( 'Search Products', 'nexiode' ),
			'not_found'                => __( 'No Products found.', 'nexiode' ),
			'not_found_in_trash'       => __( 'No Products found in Trash.', 'nexiode' ),
			'parent_item_colon'        => __( 'Parent Product:', 'nexiode' ),
			'all_items'                => __( 'All Products', 'nexiode' ),
			'archives'                 => __( 'Product Archives', 'nexiode' ),
			'attributes'               => __( 'Product Attributes', 'nexiode' ),
			'insert_into_item'         => __( 'Insert into product', 'nexiode' ),
			'uploaded_to_this_item'    => __( 'Uploaded to this product', 'nexiode' ),
			'featured_image'           => _x( 'Featured Image', 'product', 'nexiode' ),
			'set_featured_image'       => _x( 'Set featured image', 'product', 'nexiode' ),
			'remove_featured_image'    => _x( 'Remove featured image', 'product', 'nexiode' ),
			'use_featured_image'       => _x( 'Use as featured image', 'product', 'nexiode' ),
			'items_list_navigation'    => __( 'Products list navigation', 'nexiode' ),
			'items_list'               => __( 'Products list', 'nexiode' ),
			'item_published'           => __( 'Product published.', 'nexiode' ),
			'item_published_privately' => __( 'Product published privately.', 'nexiode' ),
			'item_reverted_to_draft'   => __( 'Product reverted to draft.', 'nexiode' ),
			'item_scheduled'           => __( 'Product scheduled.', 'nexiode' ),
			'item_updated'             => __( 'Product updated.', 'nexiode' ),
		);

		$rewrite = array(
			'slug'       => 'products',
			'with_front' => true,
		);

		$args = array(
			'label'              => __( 'Product', 'nexiode' ),
			'labels'             => $labels,
			'supports'           => array( 'title', 'thumbnail', 'excerpt', 'editor' ),
			'public'             => true,
			'rewrite'            => $rewrite,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-cart',
			'show_in_admin_bar'  => true,
			'show_in_nav_menus'  => true,
			'can_export'         => true,
			'has_archive'        => true,
			'publicly_queryable' => true,
			'taxonomies'         => array( 'product_cat' ),
		);

		register_post_type( 'product', $args );
	}
}
