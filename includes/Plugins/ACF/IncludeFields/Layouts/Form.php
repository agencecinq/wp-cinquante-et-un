<?php
/**
 * ACF layout: Form
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Form block layout.
 */
class Form {

	/**
	 * Returns the layout array for the Form block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_form',
			'name'       => 'form',
			'label'      => __( 'Form', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'max'        => 1,
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_form' ),
				array(
					'key'        => 'field_' . $key . '_form_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_form_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_form_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_form_content_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'          => 'field_' . $key . '_form_content_text',
							'label'        => __( 'Text', 'wp-cinquante-et-un' ),
							'name'         => 'text',
							'aria-label'   => __( 'Text', 'wp-cinquante-et-un' ),
							'type'         => 'textarea',
							'rows'         => 4,
							'new_lines'    => 'br',
							'placeholder'  => __( 'Enter the text of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Pitch shown next to the form.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_form_tab_form',
					'label'      => __( 'Form', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Form', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'           => 'field_' . $key . '_form_form',
					'label'         => __( 'Form', 'wp-cinquante-et-un' ),
					'name'          => 'form',
					'aria-label'    => __( 'Form', 'wp-cinquante-et-un' ),
					'type'          => 'post_object',
					'post_type'     => array( 'wpcf7_contact_form' ),
					'return_format' => 'id',
					'allow_null'    => 1,
					'instructions'  => __( 'Contact Form 7 form to render. Wire another plugin on the project if needed.', 'wp-cinquante-et-un' ),
				),
			),
		);
	}
}
