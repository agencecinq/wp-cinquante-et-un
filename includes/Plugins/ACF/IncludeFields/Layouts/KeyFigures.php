<?php
/**
 * ACF layout: KeyFigures
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * KeyFigures block layout.
 */
class KeyFigures {

	/**
	 * Returns the layout array for the KeyFigures block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_key_figures',
			'name'       => 'key_figures',
			'label'      => __( 'Key Figures', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_key_figures' ),
				...AcfFieldHelpers::media( $key . '_key_figures' ),
				array(
					'key'        => 'field_' . $key . '_key_figures_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_key_figures_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_key_figures_content_layout',
							'label'         => __( 'Layout', 'nexiode' ),
							'name'          => 'layout',
							'aria-label'    => __( 'Layout', 'nexiode' ),
							'type'          => 'select',
							'choices'       => array(
								'full'   => __( 'Full', 'nexiode' ),
								'column' => __( 'Column', 'nexiode' ),
							),
							'default_value' => 'full',
							'return_format' => 'value',
						),
						array(
							'key'         => 'field_' . $key . '_key_figures_content_overline',
							'label'       => __( 'Overline', 'nexiode' ),
							'name'        => 'overline',
							'aria-label'  => __( 'Overline', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the overline of the block', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_key_figures_content_title',
							'label'       => __( 'Title', 'nexiode' ),
							'name'        => 'title',
							'aria-label'  => __( 'Title', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the title of the block', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_key_figures_content_text',
							'label'       => __( 'Text', 'nexiode' ),
							'name'        => 'text',
							'aria-label'  => __( 'Text', 'nexiode' ),
							'new_lines'   => 'br',
							'type'        => 'textarea',
							'rows'        => 4,
							'placeholder' => __( 'Enter the text of the block', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_key_figures_content_link',
							'label'       => __( 'Link', 'nexiode' ),
							'name'        => 'link',
							'aria-label'  => __( 'Link', 'nexiode' ),
							'type'        => 'link',
							'placeholder' => __( 'Enter the URL of the link', 'nexiode' ),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_key_figures_tab_figures',
					'label'      => __( 'Figures', 'nexiode' ),
					'aria-label' => __( 'Figures', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_key_figures_items',
					'label'      => __( 'Items', 'nexiode' ),
					'name'       => 'items',
					'aria-label' => __( 'Items', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'         => 'field_' . $key . '_key_figures_items_label',
							'label'       => __( 'Label', 'nexiode' ),
							'name'        => 'label',
							'aria-label'  => __( 'Label', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the label of the figures', 'nexiode' ),
						),
						array(
							'key'          => 'field_' . $key . '_key_figures_items_figures',
							'label'        => __( 'Figures', 'nexiode' ),
							'name'         => 'figures',
							'aria-label'   => __( 'Figures', 'nexiode' ),
							'type'         => 'repeater',
							'max'          => 4,
							'button_label' => __( 'Add Figure', 'nexiode' ),
							'layout'       => 'block',
							'instructions' => __( 'Add up to 4 figures.', 'nexiode' ),
							'sub_fields'   => array(
								array(
									'key'             => 'field_' . $key . '_key_figures_items_figures_overline',
									'label'           => __( 'Overline', 'nexiode' ),
									'name'            => 'overline',
									'aria-label'      => __( 'Overline', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the overline of the figure', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_key_figures_items_figures',
								),
								array(
									'key'             => 'field_' . $key . '_key_figures_items_figures_content',
									'label'           => __( 'Content', 'nexiode' ),
									'name'            => 'content',
									'aria-label'      => __( 'Content', 'nexiode' ),
									'type'            => 'group',
									'layout'          => 'block',
									'parent_repeater' => 'field_' . $key . '_key_figures_items_figures',
									'sub_fields'      => array(
										array(
											'key'         => 'field_' . $key . '_key_figures_items_figures_content_overline',
											'label'       => __( 'Overline', 'nexiode' ),
											'name'        => 'overline',
											'aria-label'  => __( 'Overline', 'nexiode' ),
											'type'        => 'text',
											'placeholder' => __( 'Enter the overline of the figure', 'nexiode' ),
										),
										array(
											'key'         => 'field_' . $key . '_key_figures_items_figures_content_value',
											'label'       => __( 'Value', 'nexiode' ),
											'name'        => 'value',
											'aria-label'  => __( 'Value', 'nexiode' ),
											'type'        => 'number',
											'placeholder' => __( 'Enter the value of the figure', 'nexiode' ),
											'wrapper'     => array(
												'width' => 8 * 100 / 12,
											),
										),
										array(
											'key'         => 'field_' . $key . '_key_figures_items_figures_content_unit',
											'label'       => __( 'Unit', 'nexiode' ),
											'name'        => 'unit',
											'aria-label'  => __( 'Unit', 'nexiode' ),
											'type'        => 'text',
											'placeholder' => __( 'Enter the unit of the figure', 'nexiode' ),
											'default_value' => __( '%', 'nexiode' ),
											'wrapper'     => array(
												'width' => 4 * 100 / 12,
											),
										),
										array(
											'key'         => 'field_' . $key . '_key_figures_items_figures_content_description',
											'label'       => __( 'Description', 'nexiode' ),
											'name'        => 'description',
											'aria-label'  => __( 'Description', 'nexiode' ),
											'type'        => 'textarea',
											'rows'        => 2,
											'new_lines'   => 'br',
											'placeholder' => __( 'Enter the description of the figure', 'nexiode' ),
										),
									),
								),
								array(
									'key'             => 'field_' . $key . '_key_figures_items_figures_text',
									'label'           => __( 'Text', 'nexiode' ),
									'name'            => 'text',
									'aria-label'      => __( 'Text', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the text of the figure', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_key_figures_items_figures',
								),
							),
						),
					),
				),
			),
		);
	}
}
