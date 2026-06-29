<?php
/**
 * ACF layout: Support
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Support block layout.
 */
class Support {

	/**
	 * Returns the layout array for the Support block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_support',
			'name'       => 'support',
			'label'      => __( 'Support', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_support' ),
				AcfFieldHelpers::radius( $key . '_support' ),
				array(
					'key'        => 'field_' . $key . '_support_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_support_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_support_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'          => 'field_' . $key . '_support_content_items',
							'label'        => __( 'Items', 'nexiode' ),
							'name'         => 'items',
							'aria-label'   => __( 'Items', 'nexiode' ),
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => __( 'Add Item', 'nexiode' ),
							'min'          => 1,
							'max'          => 6,
							'sub_fields'   => array(
								array(
									'key'             => 'field_' . $key . '_support_content_items_title',
									'label'           => __( 'Title', 'nexiode' ),
									'name'            => 'title',
									'aria-label'      => __( 'Title', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the title of the item', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_support_content_items',
								),
								array(
									'key'             => 'field_' . $key . '_support_content_items_text',
									'label'           => __( 'Text', 'nexiode' ),
									'name'            => 'text',
									'aria-label'      => __( 'Text', 'nexiode' ),
									'type'            => 'textarea',
									'rows'            => 3,
									'new_lines'       => 'br',
									'placeholder'     => __( 'Enter the description', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_support_content_items',
								),
								array(
									'key'             => 'field_' . $key . '_support_content_items_link',
									'label'           => __( 'Link', 'nexiode' ),
									'name'            => 'link',
									'aria-label'      => __( 'Link', 'nexiode' ),
									'type'            => 'link',
									'return_format'   => 'array',
									'parent_repeater' => 'field_' . $key . '_support_content_items',
								),
							),
						),
					),
				),
			),
		);
	}
}
