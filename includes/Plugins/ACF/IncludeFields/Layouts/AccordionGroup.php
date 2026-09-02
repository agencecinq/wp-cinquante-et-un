<?php
/**
 * ACF layout: AccordionGroup
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * AccordionGroup block layout.
 */
class AccordionGroup {

	/**
	 * Returns the layout array for the AccordionGroup block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_accordion_group',
			'name'       => 'accordion_group',
			'label'      => __( 'FAQ', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_accordion_group' ),
				array(
					'key'        => 'field_' . $key . '_accordion_group_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_accordion_group_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_accordion_group_content_overline',
							'label'         => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'          => 'overline',
							'aria-label'    => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Overline of the block', 'wp-cinquante-et-un' ),
							'instructions'  => __( 'Optional text shown above the main title.', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'           => 'field_' . $key . '_accordion_group_content_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Title of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_accordion_group_tab_accordions',
					'label'      => __( 'Accordions', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Accordions', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'          => 'field_' . $key . '_accordion_group_accordions',
					'label'        => __( 'Accordions', 'wp-cinquante-et-un' ),
					'name'         => 'accordions',
					'aria-label'   => __( 'Accordions', 'wp-cinquante-et-un' ),
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => __( 'Add Accordion', 'wp-cinquante-et-un' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_' . $key . '_accordion_group_accordions_header',
							'label'         => __( 'Header', 'wp-cinquante-et-un' ),
							'name'          => 'header',
							'aria-label'    => __( 'Header', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the accordion', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'           => 'field_' . $key . '_accordion_group_accordions_content',
							'label'         => __( 'Content', 'wp-cinquante-et-un' ),
							'name'          => 'content',
							'aria-label'    => __( 'Content', 'wp-cinquante-et-un' ),
							'type'          => 'textarea',
							'new_lines'     => 'br',
							'rows'          => 4,
							'placeholder'   => __( 'Enter the content of the accordion', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
					),
				),
				array(
					'key'           => 'field_' . $key . '_accordion_group_schema',
					'label'         => __( 'FAQ schema', 'wp-cinquante-et-un' ),
					'name'          => 'schema',
					'aria-label'    => __( 'FAQ schema', 'wp-cinquante-et-un' ),
					'type'          => 'true_false',
					'ui'            => 1,
					'default_value' => 0,
					'instructions'  => __( 'Output FAQPage JSON-LD from the accordion items. Enable on one block per page only.', 'wp-cinquante-et-un' ),
				),
			),
		);
	}
}
