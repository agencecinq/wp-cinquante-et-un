<?php
/**
 * ACF layout: KeyFigures
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * KeyFigures block layout.
 */
class KeyFigures {

	/**
	 * Returns the layout array for the KeyFigures block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_key_figures',
			'name'       => 'key_figures',
			'label'      => __( 'Key Figures', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_key_figures' ),
				array(
					'key'        => 'field_' . $key . '_key_figures_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_key_figures_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_key_figures_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_key_figures_content_title',
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
					'key'          => 'field_' . $key . '_key_figures_figures',
					'label'        => __( 'Figures', 'wp-cinquante-et-un' ),
					'name'         => 'figures',
					'aria-label'   => __( 'Figures', 'wp-cinquante-et-un' ),
					'type'         => 'repeater',
					'min'          => 2,
					'max'          => 4,
					'layout'       => 'block',
					'button_label' => __( 'Add Figure', 'wp-cinquante-et-un' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_' . $key . '_key_figures_figures_value',
							'label'         => __( 'Value', 'wp-cinquante-et-un' ),
							'name'          => 'value',
							'aria-label'    => __( 'Value', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'required'      => 1,
							'instructions'  => __( 'Text, not a number: +68, 2.4 M, 24/7, x3.', 'wp-cinquante-et-un' ),
							'wrapper'       => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_key_figures_figures_suffix',
							'label'       => __( 'Suffix', 'wp-cinquante-et-un' ),
							'name'        => 'suffix',
							'aria-label'  => __( 'Suffix', 'wp-cinquante-et-un' ),
							'type'        => 'text',
							'placeholder' => '%',
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'        => 'field_' . $key . '_key_figures_figures_label',
							'label'      => __( 'Label', 'wp-cinquante-et-un' ),
							'name'       => 'label',
							'aria-label' => __( 'Label', 'wp-cinquante-et-un' ),
							'type'       => 'text',
							'required'   => 1,
						),
					),
				),
			),
		);
	}
}
