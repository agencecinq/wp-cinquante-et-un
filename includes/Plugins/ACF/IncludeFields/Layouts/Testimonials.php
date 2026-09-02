<?php
/**
 * ACF layout: Testimonials
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Testimonials block layout.
 */
class Testimonials {

	/**
	 * Returns the layout array for the Testimonials block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_testimonials',
			'name'       => 'testimonials',
			'label'      => __( 'Testimonials', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_testimonials' ),
				array(
					'key'        => 'field_' . $key . '_testimonials_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_testimonials_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_testimonials_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_testimonials_content_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
					),
				),
				array(
					'key'          => 'field_' . $key . '_testimonials_items',
					'label'        => __( 'Items', 'wp-cinquante-et-un' ),
					'name'         => 'items',
					'aria-label'   => __( 'Items', 'wp-cinquante-et-un' ),
					'type'         => 'repeater',
					'min'          => 1,
					'max'          => 6,
					'layout'       => 'block',
					'button_label' => __( 'Add Testimonial', 'wp-cinquante-et-un' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_' . $key . '_testimonials_items_quote',
							'label'         => __( 'Quote', 'wp-cinquante-et-un' ),
							'name'          => 'quote',
							'aria-label'    => __( 'Quote', 'wp-cinquante-et-un' ),
							'type'          => 'textarea',
							'rows'          => 4,
							'required'      => 1,
						),
						array(
							'key'           => 'field_' . $key . '_testimonials_items_author',
							'label'         => __( 'Author', 'wp-cinquante-et-un' ),
							'name'          => 'author',
							'aria-label'    => __( 'Author', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'required'      => 1,
							'wrapper'       => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_testimonials_items_role',
							'label'       => __( 'Role', 'wp-cinquante-et-un' ),
							'name'        => 'role',
							'aria-label'  => __( 'Role', 'wp-cinquante-et-un' ),
							'type'        => 'text',
							'required'    => 1,
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_testimonials_items_company',
							'label'       => __( 'Company', 'wp-cinquante-et-un' ),
							'name'        => 'company',
							'aria-label'  => __( 'Company', 'wp-cinquante-et-un' ),
							'type'        => 'text',
							'required'    => 1,
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'           => 'field_' . $key . '_testimonials_items_avatar',
							'label'         => __( 'Avatar', 'wp-cinquante-et-un' ),
							'name'          => 'avatar',
							'aria-label'    => __( 'Avatar', 'wp-cinquante-et-un' ),
							'type'          => 'image',
							'return_format' => 'id',
							'preview_size'  => 'thumbnail',
							'wrapper'       => array(
								'width' => 50,
							),
						),
					),
				),
			),
		);
	}
}
