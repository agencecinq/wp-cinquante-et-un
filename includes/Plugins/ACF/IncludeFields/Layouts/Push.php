<?php
/**
 * ACF layout: Push
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Push block layout.
 */
class Push {

	/**
	 * Returns the layout array for the Push block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_push',
			'name'       => 'push',
			'label'      => __( 'Push', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_push' ),
				array(
					'key'           => 'field_' . $key . '_push_image_position',
					'label'         => __( 'Image position', 'nexiode' ),
					'name'          => 'image_position',
					'aria-label'    => __( 'Image position', 'nexiode' ),
					'type'          => 'select',
					'instructions'  => __( 'Choose which side the image appears on.', 'nexiode' ),
					'choices'       => array(
						'left'  => __( 'Image on the left', 'nexiode' ),
						'right' => __( 'Image on the right', 'nexiode' ),
					),
					'default_value' => 'right',
					'return_format' => 'value',
				),
				...AcfFieldHelpers::media( $key . '_push' ),
				array(
					'key'           => 'field_' . $key . '_push_object_fit',
					'label'         => __( 'Object Fit', 'nexiode' ),
					'name'          => 'object_fit',
					'aria-label'    => __( 'Object Fit', 'nexiode' ),
					'type'          => 'select',
					'choices'       => array(
						'object-cover'   => __( 'Cover', 'nexiode' ),
						'object-contain' => __( 'Contain', 'nexiode' ),
					),
					'default_value' => 'object-cover',
					'instructions'  => __( 'Cover fills the area (may crop). Contain fits inside (may show empty space).', 'nexiode' ),
					'return_format' => 'value',
				),
				array(
					'key'        => 'field_' . $key . '_push_content_tab',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_push_content',
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'         => 'field_' . $key . '_push_content_title',
							'label'       => __( 'Title', 'nexiode' ),
							'name'        => 'title',
							'aria-label'  => __( 'Title', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the title of the content', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_push_content_subtitle',
							'label'       => __( 'Subtitle', 'nexiode' ),
							'name'        => 'subtitle',
							'aria-label'  => __( 'Subtitle', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the subtitle of the content', 'nexiode' ),
						),
						array(
							'key'          => 'field_' . $key . '_push_content_text',
							'label'        => __( 'Text', 'nexiode' ),
							'name'         => 'text',
							'aria-label'   => __( 'Text', 'nexiode' ),
							'type'         => 'wysiwyg',
							'tabs'         => 'all',
							'toolbar'      => 'basic',
							'media_upload' => 0,
							'placeholder'  => __( 'Enter the text of the content', 'nexiode' ),
						),
						array(
							'key'          => 'field_' . $key . '_push_content_link',
							'label'        => __( 'Link', 'nexiode' ),
							'name'         => 'link',
							'aria-label'   => __( 'Link', 'nexiode' ),
							'type'         => 'link',
							'instructions' => __( 'Enter the link URL.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
						),
						array(
							'key'          => 'field_' . $key . '_push_content_items',
							'label'        => __( 'Items', 'nexiode' ),
							'name'         => 'items',
							'aria-label'   => __( 'Items', 'nexiode' ),
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => __( 'Add Item', 'nexiode' ),
							'instructions' => __( 'Add points (icon, title, description).', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
							'min'          => 0,
							'max'          => 6,
							'sub_fields'   => array(
								array(
									'key'             => 'field_' . $key . '_push_content_items_icon',
									'label'           => __( 'Icon', 'nexiode' ),
									'name'            => 'icon',
									'aria-label'      => __( 'Icon', 'nexiode' ),
									'type'            => 'image',
									'return_format'   => 'id',
									'preview_size'    => 'thumbnail',
									'instructions'    => __( 'Select or upload an icon.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									'parent_repeater' => 'field_' . $key . '_push_content_items',
								),
								array(
									'key'             => 'field_' . $key . '_push_content_items_title',
									'label'           => __( 'Title', 'nexiode' ),
									'name'            => 'title',
									'aria-label'      => __( 'Title', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Item title', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_push_content_items',
								),
								array(
									'key'             => 'field_' . $key . '_push_content_items_text',
									'label'           => __( 'Text', 'nexiode' ),
									'name'            => 'text',
									'aria-label'      => __( 'Text', 'nexiode' ),
									'type'            => 'textarea',
									'rows'            => 2,
									'new_lines'       => 'br',
									'placeholder'     => __( 'Enter the description', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_push_content_items',
								),
							),
						),
					),
				),
			),
		);
	}
}
