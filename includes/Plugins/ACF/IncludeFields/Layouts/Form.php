<?php
/**
 * ACF layout: Form
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Form block layout.
 */
class Form {

	/**
	 * Returns the layout array for the Gallery block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_form',
			'name'       => 'form',
			'label'      => __( 'Form', 'nexiode' ),
			'display'    => 'block',
			'max'        => 1,
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_form' ),
				array(
					'key'        => 'field_' . $key . '_form_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_form_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_form_content_form',
							'label'         => __( 'Form', 'nexiode' ),
							'name'          => 'form',
							'aria-label'    => __( 'Form', 'nexiode' ),
							'type'          => 'post_object',
							'post_type'     => 'wpcf7_contact_form',
							'return_format' => 'id',
							'multiple'      => 0,
							'allow_null'    => 0,
						),
					),
				),
			),
		);
	}
}
