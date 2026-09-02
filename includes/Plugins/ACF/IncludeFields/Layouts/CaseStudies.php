<?php
/**
 * ACF layout: CaseStudies
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * CaseStudies block layout (manual cards; a CPT can replace this on a project).
 */
class CaseStudies {

	/**
	 * Returns the layout array for the CaseStudies block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_case_studies',
			'name'       => 'case_studies',
			'label'      => __( 'Case Studies', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_case_studies' ),
				array(
					'key'        => 'field_' . $key . '_case_studies_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_case_studies_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_case_studies_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_case_studies_content_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'        => 'field_' . $key . '_case_studies_content_link',
							'label'      => __( 'Link', 'wp-cinquante-et-un' ),
							'name'       => 'link',
							'aria-label' => __( 'Link', 'wp-cinquante-et-un' ),
							'type'       => 'link',
						),
					),
				),
				array(
					'key'          => 'field_' . $key . '_case_studies_items',
					'label'        => __( 'Items', 'wp-cinquante-et-un' ),
					'name'         => 'items',
					'aria-label'   => __( 'Items', 'wp-cinquante-et-un' ),
					'type'         => 'repeater',
					'min'          => 1,
					'max'          => 6,
					'layout'       => 'block',
					'button_label' => __( 'Add Case Study', 'wp-cinquante-et-un' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_' . $key . '_case_studies_items_image',
							'label'         => __( 'Image', 'wp-cinquante-et-un' ),
							'name'          => 'image',
							'aria-label'    => __( 'Image', 'wp-cinquante-et-un' ),
							'type'          => 'image',
							'return_format' => 'id',
							'preview_size'  => 'medium',
						),
						array(
							'key'         => 'field_' . $key . '_case_studies_items_sector',
							'label'       => __( 'Sector', 'wp-cinquante-et-un' ),
							'name'        => 'sector',
							'aria-label'  => __( 'Sector', 'wp-cinquante-et-un' ),
							'type'        => 'text',
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_case_studies_items_client',
							'label'       => __( 'Client', 'wp-cinquante-et-un' ),
							'name'        => 'client',
							'aria-label'  => __( 'Client', 'wp-cinquante-et-un' ),
							'type'        => 'text',
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'        => 'field_' . $key . '_case_studies_items_title',
							'label'      => __( 'Title', 'wp-cinquante-et-un' ),
							'name'       => 'title',
							'aria-label' => __( 'Title', 'wp-cinquante-et-un' ),
							'type'       => 'text',
							'required'   => 1,
						),
						array(
							'key'        => 'field_' . $key . '_case_studies_items_url',
							'label'      => __( 'URL', 'wp-cinquante-et-un' ),
							'name'       => 'url',
							'aria-label' => __( 'URL', 'wp-cinquante-et-un' ),
							'type'       => 'url',
						),
						array(
							'key'         => 'field_' . $key . '_case_studies_items_result_value',
							'label'       => __( 'Result value', 'wp-cinquante-et-un' ),
							'name'        => 'result_value',
							'aria-label'  => __( 'Result value', 'wp-cinquante-et-un' ),
							'type'        => 'text',
							'placeholder' => '+68 %',
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_case_studies_items_result_label',
							'label'       => __( 'Result label', 'wp-cinquante-et-un' ),
							'name'        => 'result_label',
							'aria-label'  => __( 'Result label', 'wp-cinquante-et-un' ),
							'type'        => 'text',
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
