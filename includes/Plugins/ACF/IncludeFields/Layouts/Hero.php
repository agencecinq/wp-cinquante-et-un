<?php
/**
 * ACF layout: Hero
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Hero block layout.
 */
class Hero {

	/**
	 * Returns the layout array for the Hero block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_hero',
			'name'       => 'hero',
			'label'      => __( 'Hero', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_hero' ),
				...AcfFieldHelpers::media( $key . '_hero' ),
				array(
					'key'        => 'field_' . $key . '_hero_content_tab',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_hero_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_hero_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'        => 'field_' . $key . '_hero_content_heading',
							'label'      => __( 'Heading', 'nexiode' ),
							'name'       => 'heading',
							'aria-label' => __( 'Heading', 'nexiode' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_heading' ),
							'display'    => 'seamless',
							'layout'     => 'block',
						),
						array(
							'key'           => 'field_' . $key . '_hero_content_link',
							'label'         => __( 'Link', 'nexiode' ),
							'name'          => 'link',
							'aria-label'    => __( 'Link', 'nexiode' ),
							'type'          => 'link',
							'placeholder'   => __( 'Enter the URL of the link', 'nexiode' ),
							'default_value' => '',
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_hero_footer_tab',
					'label'      => __( 'Footer', 'nexiode' ),
					'aria-label' => __( 'Footer', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_hero_footer',
					'label'      => __( 'Footer', 'nexiode' ),
					'name'       => 'footer',
					'aria-label' => __( 'Footer', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_hero_footer_items',
							'label'        => __( 'Items', 'nexiode' ),
							'name'         => 'items',
							'aria-label'   => __( 'Items', 'nexiode' ),
							'type'         => 'repeater',
							'instructions' => __( 'Add up to 3 items. Leave empty to hide the footer.', 'nexiode' ),
							'layout'       => 'block',
							'max'          => 3,
							'button_label' => __( 'Add Item', 'nexiode' ),
							'sub_fields'   => array(
								array(
									'key'     => 'field_' . $key . '_hero_footer_items_image',
									'label'   => __( 'Image', 'nexiode' ),
									'name'    => 'image',
									'aria-label' => __( 'Image', 'nexiode' ),
									'type'    => 'image',
									'instructions' => '<em>' . __( 'Optional', 'nexiode' ) . '</em>',
									'wrapper' => array(
										'width' => 4 * 100 / 12,
									),
									'preview_size' => 'thumbnail',
									'return_format' => 'id',
									'parent_repeater' => 'field_' . $key . '_hero_footer_items',
								),
								array(
									'key'     => 'field_' . $key . '_hero_footer_items_title',
									'label'   => __( 'Title', 'nexiode' ),
									'name'    => 'title',
									'aria-label' => __( 'Title', 'nexiode' ),
									'type'    => 'text',
									'wrapper' => array(
										'width' => 8 * 100 / 12,
									),
									'placeholder' => __( 'Enter the title of the item', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_hero_footer_items',
								),
							),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_hero_featured_posts_tab',
					'label'      => __( 'Featured Posts', 'nexiode' ),
					'aria-label' => __( 'Featured Posts', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_hero_featured_posts',
					'label'      => __( 'Featured Posts', 'nexiode' ),
					'name'       => 'featured_posts',
					'aria-label' => __( 'Featured Posts', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_hero_featured_posts_posts',
							'label'         => __( 'Posts', 'nexiode' ),
							'name'          => 'posts',
							'aria-label'    => __( 'Posts', 'nexiode' ),
							'type'          => 'relationship',
							'post_type'     => 'post',
							'multiple'      => true,
							'return_format' => 'id',
						),
					),
				),
			),
		);
	}
}
