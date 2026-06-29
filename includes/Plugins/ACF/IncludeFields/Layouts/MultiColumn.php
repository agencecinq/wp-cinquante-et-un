<?php
/**
 * ACF layout: MultiColumn
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * MultiColumn block layout.
 */
class MultiColumn {

	/**
	 * Returns the layout array for the MultiColumn block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_multi_column',
			'name'       => 'multi_column',
			'label'      => __( 'Multi Column', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_multi_column' ),
				AcfFieldHelpers::radius( $key . '_multi_column' ),
				array(
					'key'        => 'field_' . $key . '_multi_column_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_multi_column_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_multi_column_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'textarea',
							'rows'          => 2,
							'new_lines'     => 'br',
							'placeholder'   => __( 'Enter the title of the block', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'          => 'field_' . $key . '_multi_column_content_title_style',
							'label'        => __( 'Title Style', 'nexiode' ),
							'name'         => 'title_style',
							'aria-label'   => __( 'Title Style', 'nexiode' ),
							'instructions' => __( 'Visual style only; does not change the heading level.', 'nexiode' ),
							'type'         => 'clone',
							'clone'        => array( 'field_clones_style' ),
							'layout'       => 'block',
							'display'      => 'seamless',
						),
						array(
							'key'        => 'field_' . $key . '_multi_column_content_text_alignment',
							'label'      => __( 'Text Alignment', 'nexiode' ),
							'name'       => 'text_alignment',
							'aria-label' => __( 'Text Alignment', 'nexiode' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_text_alignment' ),
							'layout'     => 'block',
							'display'    => 'seamless',
						),
						array(
							'key'        => 'field_' . $key . '_multi_column_content_texts',
							'label'      => __( 'Texts', 'nexiode' ),
							'name'       => 'texts',
							'aria-label' => __( 'Texts', 'nexiode' ),
							'type'       => 'group',
							'layout'     => 'block',
							'sub_fields' => array(
								array(
									'key'         => 'field_' . $key . '_multi_column_content_texts_0',
									'label'       => __( 'First text', 'nexiode' ),
									'name'        => 0,
									'aria-label'  => __( 'First text', 'nexiode' ),
									'type'        => 'textarea',
									'rows'        => 4,
									'new_lines'   => 'br',
									'placeholder' => __( 'Enter the first text of the block', 'nexiode' ),
									'wrapper'     => array(
										'width' => 6 * 100 / 12,
									),
								),
								array(
									'key'         => 'field_' . $key . '_multi_column_content_texts_1',
									'label'       => __( 'Second text', 'nexiode' ),
									'name'        => 1,
									'aria-label'  => __( 'Second text', 'nexiode' ),
									'type'        => 'textarea',
									'rows'        => 4,
									'new_lines'   => 'br',
									'placeholder' => __( 'Enter the second text of the block', 'nexiode' ),
									'wrapper'     => array(
										'width' => 6 * 100 / 12,
									),
								),
							),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_multi_column_first_row_tab',
					'label'      => __( 'First Row', 'nexiode' ),
					'name'       => 'first_row',
					'aria-label' => __( 'First Row', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_multi_column_first_row',
					'label'      => __( 'First Row', 'nexiode' ),
					'name'       => 'first_row',
					'aria-label' => __( 'First Row', 'nexiode' ),
					'type'       => 'group',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_multi_column_first_row_columns',
							'label'        => __( 'Columns', 'nexiode' ),
							'name'         => 'columns',
							'aria-label'   => __( 'Columns', 'nexiode' ),
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => __( 'Add Column', 'nexiode' ),
							'max'          => 3,
							'sub_fields'   => array(
								array(
									'key'        => 'field_' . $key . '_multi_column_first_row_columns_image',
									'label'      => __( 'Image', 'nexiode' ),
									'name'       => 'image',
									'aria-label' => __( 'Image', 'nexiode' ),
									'type'       => 'image',
								),
								array(
									'key'          => 'field_' . $key . '_multi_column_first_row_columns_pins',
									'label'        => __( 'Pins', 'nexiode' ),
									'name'         => 'pins',
									'aria-label'   => __( 'Pins', 'nexiode' ),
									'type'         => 'repeater',
									'layout'       => 'block',
									'button_label' => __( 'Add Pin', 'nexiode' ),
									'sub_fields'   => array(
										array(
											'key'         => 'field_' . $key . '_multi_column_first_row_columns_pins_title',
											'label'       => __( 'Title', 'nexiode' ),
											'name'        => 'title',
											'aria-label'  => __( 'Title', 'nexiode' ),
											'type'        => 'text',
											'placeholder' => __( 'Enter the title of the pin', 'nexiode' ),
											'parent_repeater' => 'field_' . $key . '_multi_column_first_row_columns_pins',
										),
										array(
											'key'         => 'field_' . $key . '_multi_column_first_row_columns_pins_text',
											'label'       => __( 'Text', 'nexiode' ),
											'name'        => 'text',
											'aria-label'  => __( 'Text', 'nexiode' ),
											'type'        => 'textarea',
											'rows'        => 2,
											'new_lines'   => 'br',
											'placeholder' => __( 'Enter the text of the pin', 'nexiode' ),
											'parent_repeater' => 'field_' . $key . '_multi_column_first_row_columns_pins',
										),
										array(
											'key'         => 'field_' . $key . '_multi_column_first_row_columns_pins_subtitle',
											'label'       => __( 'Subtitle', 'nexiode' ),
											'name'        => 'subtitle',
											'aria-label'  => __( 'Subtitle', 'nexiode' ),
											'type'        => 'text',
											'placeholder' => __( 'Enter the subtitle of the pin', 'nexiode' ),
											'parent_repeater' => 'field_' . $key . '_multi_column_first_row_columns_pins',
										),
										array(
											'key'          => 'field_' . $key . '_multi_column_first_row_columns_pins_images',
											'label'        => __( 'Images', 'nexiode' ),
											'name'         => 'images',
											'aria-label'   => __( 'Images', 'nexiode' ),
											'type'         => 'gallery',
											'instructions' => __( 'Select or upload images.', 'nexiode' ),
											'parent_repeater' => 'field_' . $key . '_multi_column_first_row_columns_pins',
										),
										array(
											'key'        => 'field_' . $key . '_multi_column_first_row_columns_pins_coordinates',
											'label'      => __( 'Coordinates', 'nexiode' ),
											'name'       => 'coordinates',
											'aria-label' => __( 'Coordinates', 'nexiode' ),
											'parent_repeater' => 'field_' . $key . '_multi_column_first_row_columns_pins',
											'type'       => 'group',
											'sub_fields' => array(
												array(
													'key'  => 'field_' . $key . '_multi_column_first_row_columns_pins_coordinates_top',
													'label' => __( 'Top', 'nexiode' ),
													'name' => 'top',
													'aria-label' => __( 'Top', 'nexiode' ),
													'type' => 'number',
													'min'  => 0,
													'max'  => 100,
													'step' => 0.01,
													'default_value' => 0,
													'append' => __( '%', 'nexiode' ),
													'wrapper' => array(
														'width' => 6 * 100 / 12,
													),
												),
												array(
													'key'  => 'field_' . $key . '_multi_column_first_row_columns_pins_coordinates_left',
													'label' => __( 'Left', 'nexiode' ),
													'name' => 'left',
													'aria-label' => __( 'Left', 'nexiode' ),
													'type' => 'number',
													'min'  => 0,
													'step' => 0.01,
													'max'  => 100,
													'default_value' => 0,
													'append' => __( '%', 'nexiode' ),
													'wrapper' => array(
														'width' => 6 * 100 / 12,
													),
												),
											),
										),
									),
								),
							),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_multi_column_second_row_tab',
					'label'      => __( 'Second Row', 'nexiode' ),
					'name'       => 'second_row',
					'aria-label' => __( 'Second Row', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_multi_column_second_row',
					'label'      => __( 'Second Row', 'nexiode' ),
					'name'       => 'second_row',
					'aria-label' => __( 'Second Row', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_multi_column_second_row_columns',
							'label'        => __( 'Columns', 'nexiode' ),
							'name'         => 'columns',
							'aria-label'   => __( 'Columns', 'nexiode' ),
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => __( 'Add Column', 'nexiode' ),
							'max'          => 3,
							'sub_fields'   => array(
								array(
									'key'             => 'field_' . $key . '_multi_column_second_row_columns_image',
									'label'           => __( 'Image', 'nexiode' ),
									'name'            => 'image',
									'aria-label'      => __( 'Image', 'nexiode' ),
									'type'            => 'image',
									'parent_repeater' => 'field_' . $key . '_multi_column_second_row_columns',
								),
								array(
									'key'             => 'field_' . $key . '_multi_column_second_row_columns_title',
									'label'           => __( 'Title', 'nexiode' ),
									'name'            => 'title',
									'aria-label'      => __( 'Title', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the title of the column', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_multi_column_second_row_columns',
								),
								array(
									'key'             => 'field_' . $key . '_multi_column_second_row_columns_heading',
									'label'           => __( 'Heading', 'nexiode' ),
									'name'            => 'heading',
									'aria-label'      => __( 'Heading', 'nexiode' ),
									'type'            => 'clone',
									'clone'           => array( 'field_clones_heading' ),
									'layout'          => 'block',
									'display'         => 'seamless',
									'parent_repeater' => 'field_' . $key . '_multi_column_second_row_columns',
								),
								array(
									'key'             => 'field_' . $key . '_multi_column_second_row_columns_subtitle',
									'label'           => __( 'Subtitle', 'nexiode' ),
									'name'            => 'subtitle',
									'aria-label'      => __( 'Subtitle', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the subtitle of the column', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_multi_column_second_row_columns',
								),
								array(
									'key'             => 'field_' . $key . '_multi_column_second_row_columns_text',
									'label'           => __( 'Text', 'nexiode' ),
									'name'            => 'text',
									'aria-label'      => __( 'Text', 'nexiode' ),
									'type'            => 'textarea',
									'rows'            => 4,
									'new_lines'       => 'br',
									'placeholder'     => __( 'Enter the text of the column', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_multi_column_second_row_columns',
								),
								array(
									'key'             => 'field_' . $key . '_multi_column_second_row_columns_link',
									'label'           => __( 'Link', 'nexiode' ),
									'name'            => 'link',
									'aria-label'      => __( 'Link', 'nexiode' ),
									'type'            => 'link',
									'placeholder'     => __( 'Enter the link URL.', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_multi_column_second_row_columns',
								),
							),
						),
					),
				),
			),
		);
	}
}
