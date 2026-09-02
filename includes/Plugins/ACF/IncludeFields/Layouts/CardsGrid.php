<?php
/**
 * ACF layout: CardsGrid
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * CardsGrid block layout.
 */
class CardsGrid {

	/**
	 * Returns the layout array for the CardsGrid block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_cards_grid',
			'name'       => 'cards_grid',
			'label'      => __( 'Cards Grid', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_cards_grid' ),
				array(
					'key'           => 'field_' . $key . '_cards_grid_columns',
					'label'         => __( 'Columns', 'wp-cinquante-et-un' ),
					'name'          => 'columns',
					'aria-label'    => __( 'Columns', 'wp-cinquante-et-un' ),
					'type'          => 'select',
					'choices'       => array(
						2 => '2',
						3 => '3',
						4 => '4',
					),
					'default_value' => 3,
					'return_format' => 'value',
					'instructions'  => __( 'Always one column below the md breakpoint.', 'wp-cinquante-et-un' ),
				),
				array(
					'key'        => 'field_' . $key . '_cards_grid_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_cards_grid_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_cards_grid_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_cards_grid_content_title',
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
					'key'          => 'field_' . $key . '_cards_grid_cards',
					'label'        => __( 'Cards', 'wp-cinquante-et-un' ),
					'name'         => 'cards',
					'aria-label'   => __( 'Cards', 'wp-cinquante-et-un' ),
					'type'         => 'repeater',
					'min'          => 2,
					'max'          => 12,
					'layout'       => 'block',
					'button_label' => __( 'Add Card', 'wp-cinquante-et-un' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_' . $key . '_cards_grid_cards_icon',
							'label'         => __( 'Icon', 'wp-cinquante-et-un' ),
							'name'          => 'icon',
							'aria-label'    => __( 'Icon', 'wp-cinquante-et-un' ),
							'type'          => 'image',
							'return_format' => 'id',
							'preview_size'  => 'thumbnail',
							'instructions'  => __( 'Optional SVG.', 'wp-cinquante-et-un' ),
						),
						array(
							'key'           => 'field_' . $key . '_cards_grid_cards_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'text',
							'required'      => 1,
						),
						array(
							'key'           => 'field_' . $key . '_cards_grid_cards_text',
							'label'         => __( 'Text', 'wp-cinquante-et-un' ),
							'name'          => 'text',
							'aria-label'    => __( 'Text', 'wp-cinquante-et-un' ),
							'type'          => 'textarea',
							'rows'          => 3,
							'new_lines'     => 'br',
						),
						array(
							'key'        => 'field_' . $key . '_cards_grid_cards_link',
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
