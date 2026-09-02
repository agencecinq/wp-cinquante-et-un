<?php
/**
 * ACF layout: Logos
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Logos block layout (logo strip).
 */
class Logos {

	/**
	 * Returns the layout array for the Logos block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_logos',
			'name'       => 'logos',
			'label'      => __( 'Logos', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_logos' ),
				array(
					'key'        => 'field_' . $key . '_logos_content_tab',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'           => 'field_' . $key . '_logos_title',
					'label'         => __( 'Title', 'wp-cinquante-et-un' ),
					'name'          => 'title',
					'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
					'type'          => 'text',
					'placeholder'   => __( 'They trust us', 'wp-cinquante-et-un' ),
					'default_value' => '',
				),
				array(
					'key'           => 'field_' . $key . '_logos_logos',
					'label'         => __( 'Logos', 'wp-cinquante-et-un' ),
					'name'          => 'logos',
					'aria-label'    => __( 'Logos', 'wp-cinquante-et-un' ),
					'type'          => 'gallery',
					'return_format' => 'id',
					'preview_size'  => 'medium',
					'instructions'  => __( 'Prefer monochrome SVGs. Images are rendered at a fixed height.', 'wp-cinquante-et-un' ),
				),
				array(
					'key'           => 'field_' . $key . '_logos_grayscale',
					'label'         => __( 'Grayscale', 'wp-cinquante-et-un' ),
					'name'          => 'grayscale',
					'aria-label'    => __( 'Grayscale', 'wp-cinquante-et-un' ),
					'type'          => 'true_false',
					'default_value' => 1,
					'ui'            => 1,
				),
			),
		);
	}
}
