<?php
/**
 * ACF layout: Cta
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Cta block layout.
 */
class Cta {

	/**
	 * Returns the layout array for the Cta block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_cta',
			'name'       => 'cta',
			'label'      => __( 'CTA', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_cta' ),
				array(
					'key'        => 'field_' . $key . '_cta_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_cta_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_cta_content_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'        => 'field_' . $key . '_cta_content_heading',
							'label'      => __( 'Heading', 'wp-cinquante-et-un' ),
							'name'       => 'heading',
							'aria-label' => __( 'Heading', 'wp-cinquante-et-un' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_heading' ),
							'display'    => 'seamless',
							'layout'     => 'block',
						),
						array(
							'key'           => 'field_' . $key . '_cta_content_text',
							'label'         => __( 'Text', 'wp-cinquante-et-un' ),
							'name'          => 'text',
							'aria-label'    => __( 'Text', 'wp-cinquante-et-un' ),
							'type'          => 'textarea',
							'rows'          => 3,
							'new_lines'     => 'br',
						),
						array(
							'key'        => 'field_' . $key . '_cta_content_link',
							'label'      => __( 'Link', 'wp-cinquante-et-un' ),
							'name'       => 'link',
							'aria-label' => __( 'Link', 'wp-cinquante-et-un' ),
							'type'       => 'link',
						),
					),
				),
			),
		);
	}
}
