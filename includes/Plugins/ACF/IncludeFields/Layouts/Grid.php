<?php
/**
 * ACF layout: Grid
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Grid block layout.
 */
class Grid {

	/**
	 * Returns the layout array for the Grid block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_grid',
			'name'       => 'grid',
			'label'      => __( 'Grid', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_grid' ),
				array(
					'key'           => 'field_' . $key . '_grid_color_scheme',
					'label'         => __( 'Color Scheme', 'nexiode' ),
					'name'          => 'color_scheme',
					'aria-label'    => __( 'Color Scheme', 'nexiode' ),
					'type'          => 'select',
					'choices'       => array(
						'light' => __( 'Light', 'nexiode' ),
						'dark'  => __( 'Dark', 'nexiode' ),
					),
					'default_value' => 'light',
					'return_format' => 'value',
					'wrapper'       => array(
						'width' => 6 * 100 / 12,
					),
				),
				AcfFieldHelpers::radius( $key . '_grid' ),
				array(
					'key'        => 'field_' . $key . '_grid_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_grid_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_grid_content_items',
							'label'        => __( 'Items', 'nexiode' ),
							'name'         => 'items',
							'aria-label'   => __( 'Items', 'nexiode' ),
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => __( 'Add Item', 'nexiode' ),
							'sub_fields'   => array(
								array(
									'key'             => 'field_' . $key . '_grid_content_items_image',
									'label'           => __( 'Image', 'nexiode' ),
									'name'            => 'image',
									'aria-label'      => __( 'Image', 'nexiode' ),
									'type'            => 'image',
									'instructions'    => __( 'If a video is selected, the image will be ignored or used as a poster.', 'nexiode' ) . ' <em>' . __( 'Optional', 'nexiode' ) . '</em>.',
									'preview_size'    => 'thumbnail',
									'return_format'   => 'id',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'wrapper'         => array(
										'width' => 6 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_video',
									'label'           => __( 'Video', 'nexiode' ),
									'name'            => 'video',
									'aria-label'      => __( 'Video', 'nexiode' ),
									'type'            => 'file',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'instructions'    => __( 'Supported formats: mp4, mpeg, avi, ogv, webm, and 3gp.', 'nexiode' ) . ' <em>' . __( 'Optional', 'nexiode' ) . '</em>.',
									'return_format'   => 'array',
									'library'         => 'all',
									'mime_types'      => 'mp4,mpeg,avi,ogv,webm,3gp',
									'wrapper'         => array(
										'width' => 6 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_object_fit',
									'label'           => __( 'Object Fit', 'nexiode' ),
									'name'            => 'object_fit',
									'aria-label'      => __( 'Object Fit', 'nexiode' ),
									'type'            => 'select',
									'choices'         => array(
										'object-cover'   => __( 'Cover', 'nexiode' ),
										'object-contain' => __( 'Contain', 'nexiode' ),
									),
									'default_value'   => 'object-cover',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'instructions'    => __( 'Cover fills the area (may crop). Contain fits inside (may show empty space).', 'nexiode' ),
									'return_format'   => 'value',
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_title',
									'label'           => __( 'Title', 'nexiode' ),
									'name'            => 'title',
									'aria-label'      => __( 'Title', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the title of the item', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_text',
									'label'           => __( 'Text', 'nexiode' ),
									'name'            => 'text',
									'aria-label'      => __( 'Text', 'nexiode' ),
									'type'            => 'textarea',
									'rows'            => 4,
									'new_lines'       => 'br',
									'placeholder'     => __( 'Enter the text of the item', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_link',
									'label'           => __( 'Link', 'nexiode' ),
									'name'            => 'link',
									'aria-label'      => __( 'Link', 'nexiode' ),
									'type'            => 'link',
									'instructions'    => '<em>' . __( 'Optional', 'nexiode' ) . '</em>',
									'placeholder'     => __( 'Enter the URL of the link', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'wrapper'         => array(
										'width' => 6 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_logo',
									'label'           => __( 'Logo', 'nexiode' ),
									'name'            => 'logo',
									'aria-label'      => __( 'Logo', 'nexiode' ),
									'type'            => 'image',
									'instructions'    => '<em>' . __( 'Optional', 'nexiode' ) . '</em>',
									'preview_size'    => 'thumbnail',
									'return_format'   => 'id',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'wrapper'         => array(
										'width' => 6 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_background_color',
									'label'           => __( 'Background Color', 'nexiode' ),
									'name'            => 'background_color',
									'aria-label'      => __( 'Background Color', 'nexiode' ),
									'type'            => 'select',
									'choices'         => array(
										'bg-bleu-nexiode'  => __( 'Blue', 'nexiode' ),
										'bg-vert-nexiode'  => __( 'Green', 'nexiode' ),
										'bg-blanc-nexiode' => __( 'White', 'nexiode' ),
										'bg-rouge-nexiode/80' => __( 'Red', 'nexiode' ),
									),
									'default_value'   => 'bg-blanc-nexiode',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'return_format'   => 'value',
									'wrapper'         => array(
										'width' => 4 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_text_color',
									'label'           => __( 'Text Color', 'nexiode' ),
									'name'            => 'text_color',
									'aria-label'      => __( 'Text Color', 'nexiode' ),
									'type'            => 'select',
									'choices'         => array(
										'text-bleu-nexiode'  => __( 'Blue', 'nexiode' ),
										'text-blanc-nexiode' => __( 'White', 'nexiode' ),
									),
									'default_value'   => 'text-bleu-nexiode',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'return_format'   => 'value',
									'wrapper'         => array(
										'width' => 4 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_fill_color',
									'label'           => __( 'Fill Color', 'nexiode' ),
									'name'            => 'fill_color',
									'aria-label'      => __( 'Fill Color', 'nexiode' ),
									'type'            => 'select',
									'choices'         => array(
										'text-vert-nexiode'  => __( 'Green', 'nexiode' ),
										'text-blanc-nexiode' => __( 'White', 'nexiode' ),
									),
									'default_value'   => 'text-vert-nexiode',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'return_format'   => 'value',
									'wrapper'         => array(
										'width' => 4 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_column_span',
									'label'           => __( 'Column Span', 'nexiode' ),
									'name'            => 'column_span',
									'aria-label'      => __( 'Column Span', 'nexiode' ),
									'type'            => 'select',
									'choices'         => array(
										'lg:col-span-6' => __( 'Full', 'nexiode' ),
										'lg:col-span-4' => __( 'Two Thirds', 'nexiode' ),
										'lg:col-span-3' => __( 'Half', 'nexiode' ),
										'lg:col-span-2' => __( 'One Third', 'nexiode' ),
									),
									'default_value'   => 'lg:col-span-2',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'wrapper'         => array(
										'width' => 6 * 100 / 12,
									),
								),
								array(
									'key'             => 'field_' . $key . '_grid_content_items_row_span',
									'label'           => __( 'Row Span', 'nexiode' ),
									'name'            => 'row_span',
									'aria-label'      => __( 'Row Span', 'nexiode' ),
									'type'            => 'select',
									'choices'         => array(
										'lg:row-span-2' => __( 'Double', 'nexiode' ),
										'lg:row-span-1' => __( 'Single', 'nexiode' ),
									),
									'default_value'   => 'lg:row-span-1',
									'parent_repeater' => 'field_' . $key . '_grid_content_items',
									'wrapper'         => array(
										'width' => 6 * 100 / 12,
									),
								),
							),
						),
					),
				),
			),
		);
	}
}
