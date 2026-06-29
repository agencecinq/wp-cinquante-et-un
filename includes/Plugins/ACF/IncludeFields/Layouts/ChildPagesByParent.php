<?php
/**
 * ACF layout: ChildPagesByParent
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * ChildPagesByParent block layout.
 */
class ChildPagesByParent {

	/**
	 * Returns the layout array for the ChildPagesByParent block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(

			'key'        => 'layout_' . $key . '_child_pages_by_parent',
			'name'       => 'child_pages_by_parent',
			'label'      => __( 'Child Pages by Parent', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				array(
					'key'        => 'field_' . $key . '_child_pages_by_parent_message',
					'label'      => __( 'Message', 'nexiode' ),
					'name'       => 'message',
					'aria-label' => __( 'Message', 'nexiode' ),
					'type'       => 'message',
					'message'    => __( 'Displays the child pages of the selected parent page. Hidden when the parent has no child pages.', 'nexiode' ),
				),
				...AcfFieldHelpers::settings( $key . '_child_pages_by_parent' ),
				array(
					'key'        => 'field_' . $key . '_child_pages_by_parent_content_tab',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_child_pages_by_parent_content',
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_child_pages_by_parent_content_parent_page',
							'label'         => __( 'Parent Page', 'nexiode' ),
							'name'          => 'parent_page',
							'aria-label'    => __( 'Parent Page', 'nexiode' ),
							'type'          => 'post_object',
							'post_type'     => 'page',
							'placeholder'   => __( 'Select the parent page', 'nexiode' ),
							'return_format' => 'id',
						),
						array(
							'key'           => 'field_' . $key . '_child_pages_by_parent_content_text',
							'label'         => __( 'Text', 'nexiode' ),
							'name'          => 'text',
							'aria-label'    => __( 'Text', 'nexiode' ),
							'instructions'  => __( 'Optional text shown below the parent page chips.', 'nexiode' ),
							'type'          => 'textarea',
							'rows'          => 4,
							'new_lines'     => 'br',
							'placeholder'   => __( 'Enter the text of the block', 'nexiode' ),
							'default_value' => '',
						),
					),
				),
			),
		);
	}
}
