<?php // phpcs:ignore
/**
 * Product Fields
 *
 * @package WordPress
 * @subpackage Nexiode
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Service;

/**
 * Product Fields
 */
class ProductFields implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields() {
		$key            = 'product';
		$hide_on_screen = array();
		$location       = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'product',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key . '_general_tab',
				'label'      => __( 'General', 'nexiode' ),
				'name'       => 'general',
				'aria-label' => __( 'General', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_general',
				'label'      => __( 'General', 'nexiode' ),
				'name'       => 'general',
				'aria-label' => __( 'General', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'         => 'field_' . $key . '_general_description',
						'label'       => __( 'Description', 'nexiode' ),
						'name'        => 'description',
						'aria-label'  => __( 'Description', 'nexiode' ),
						'type'        => 'text',
						'placeholder' => __( 'Enter the description of the product', 'nexiode' ),
					),
					array(
						'key'           => 'field_' . $key . '_general_file',
						'label'         => __( 'File', 'nexiode' ),
						'name'          => 'file',
						'aria-label'    => __( 'File', 'nexiode' ),
						'type'          => 'file',
						'return_format' => 'array',
						'library'       => 'all',
					),
				),
			),
			array(
				'key'        => 'field_' . $key . '_accordion_group_tab',
				'label'      => __( 'Accordion Group', 'nexiode' ),
				'name'       => 'accordion_group',
				'aria-label' => __( 'Accordion Group', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_accordion_group',
				'label'      => __( 'Accordion Group', 'nexiode' ),
				'name'       => 'accordion_group',
				'aria-label' => __( 'Accordion Group', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'          => 'field_' . $key . '_accordion_group_accordions',
						'label'        => __( 'Accordions', 'nexiode' ),
						'name'         => 'accordions',
						'aria-label'   => __( 'Accordions', 'nexiode' ),
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Accordion', 'nexiode' ),
						'sub_fields'   => array(
							array(
								'key'           => 'field_' . $key . '_accordion_group_accordions_header',
								'label'         => __( 'Header', 'nexiode' ),
								'name'          => 'header',
								'aria-label'    => __( 'Header', 'nexiode' ),
								'type'          => 'text',
								'placeholder'   => __( 'Enter the title of the accordion', 'nexiode' ),
								'default_value' => '',
							),
							array(
								'key'           => 'field_' . $key . '_accordion_group_accordions_content',
								'label'         => __( 'Content', 'nexiode' ),
								'name'          => 'content',
								'aria-label'    => __( 'Content', 'nexiode' ),
								'type'          => 'textarea',
								'new_lines'     => 'br',
								'rows'          => 4,
								'placeholder'   => __( 'Enter the content of the accordion', 'nexiode' ),
								'default_value' => '',
							),
						),
					),
				),
			),
			array(
				'key'        => 'field_' . $key . '_gallery_tab',
				'label'      => __( 'Gallery', 'nexiode' ),
				'name'       => 'gallery',
				'aria-label' => __( 'Gallery', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_gallery',
				'label'      => __( 'Gallery', 'nexiode' ),
				'name'       => 'gallery',
				'aria-label' => __( 'Gallery', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_' . $key . '_gallery_images',
						'label'         => __( 'Images', 'nexiode' ),
						'name'          => 'images',
						'aria-label'    => __( 'Images', 'nexiode' ),
						'type'          => 'gallery',
						'return_format' => 'array',
						'library'       => 'all',
					),
				),
			),
			array(
				'key'        => 'field_' . $key . '_reassurance_tab',
				'label'      => __( 'Reassurance', 'nexiode' ),
				'name'       => 'reassurance',
				'aria-label' => __( 'Reassurance', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_reassurance',
				'label'      => __( 'Reassurance', 'nexiode' ),
				'name'       => 'reassurance',
				'aria-label' => __( 'Reassurance', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'          => 'field_' . $key . '_reassurance_items',
						'label'        => __( 'Items', 'nexiode' ),
						'name'         => 'items',
						'aria-label'   => __( 'Items', 'nexiode' ),
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => __( 'Add Item', 'nexiode' ),
						'sub_fields'   => array(
							array(
								'key'           => 'field_' . $key . '_reassurance_items_image',
								'label'         => __( 'Image', 'nexiode' ),
								'name'          => 'image',
								'aria-label'    => __( 'Image', 'nexiode' ),
								'type'          => 'image',
								'return_format' => 'array',
								'library'       => 'all',
								'wrapper'       => array(
									'width' => 4 / 12 * 100,
								),
							),
							array(
								'key'           => 'field_' . $key . '_reassurance_items_text',
								'label'         => __( 'Text', 'nexiode' ),
								'name'          => 'text',
								'aria-label'    => __( 'Text', 'nexiode' ),
								'type'          => 'textarea',
								'new_lines'     => 'br',
								'rows'          => 2,
								'placeholder'   => __( 'Enter the text of the item', 'nexiode' ),
								'default_value' => '',
								'wrapper'       => array(
									'width' => 8 / 12 * 100,
								),
							),
						),
					),
				),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'      => 'group_' . $key,
					'title'    => __( 'Product Fields', 'nexiode' ),
					'fields'   => $fields,
					'location' => $location,
				)
			);

		}
	}
}
