<?php
/**
 * ACF layout: Columns
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Columns block layout (two-column text).
 */
class Columns {

	/**
	 * Returns the layout array for the Columns block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_columns',
			'name'       => 'columns',
			'label'      => __( 'Columns', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_columns' ),
				array(
					'key'        => 'field_' . $key . '_columns_content_tab',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_columns_content',
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'         => 'field_' . $key . '_columns_content_column_left',
							'label'       => __( 'Left column', 'nexiode' ),
							'name'        => 'column_left',
							'aria-label'  => __( 'Left column', 'nexiode' ),
							'type'        => 'textarea',
							'rows'        => 6,
							'new_lines'   => 'br',
							'placeholder' => __( 'Enter the text for the left column', 'nexiode' ),
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_columns_content_column_right',
							'label'       => __( 'Right column', 'nexiode' ),
							'name'        => 'column_right',
							'aria-label'  => __( 'Right column', 'nexiode' ),
							'type'        => 'textarea',
							'rows'        => 6,
							'new_lines'   => 'br',
							'placeholder' => __( 'Enter the text for the right column', 'nexiode' ),
							'wrapper'     => array(
								'width' => 50,
							),
						),
					),
				),
			),
		);
	}
}
