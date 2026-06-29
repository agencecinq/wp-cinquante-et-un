<?php
/**
 * ACF layout: StoreLocator
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * StoreLocator block layout.
 */
class StoreLocator {

	/**
	 * Returns the layout array for the StoreLocator block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_store_locator',
			'name'       => 'store_locator',
			'label'      => __( 'Store Locator', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_store_locator' ),
				array(
					'key'        => 'field_' . $key . '_store_locator_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_store_locator_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_store_locator_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Title of the block', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'           => 'field_' . $key . '_store_locator_content_text',
							'label'         => __( 'Text', 'nexiode' ),
							'name'          => 'text',
							'aria-label'    => __( 'Text', 'nexiode' ),
							'type'          => 'textarea',
							'rows'          => 4,
							'new_lines'     => 'br',
							'placeholder'   => __( 'Enter the text of the block', 'nexiode' ),
							'default_value' => '',
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_store_locator_stores_tab',
					'label'      => __( 'Stores', 'nexiode' ),
					'aria-label' => __( 'Stores', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_store_locator_stores',
					'label'      => __( 'Stores', 'nexiode' ),
					'name'       => 'stores',
					'aria-label' => __( 'Stores', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_store_locator_stores_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the store', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'          => 'field_' . $key . '_store_locator_stores_items',
							'label'        => __( 'Items', 'nexiode' ),
							'name'         => 'items',
							'aria-label'   => __( 'Items', 'nexiode' ),
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => __( 'Add Item', 'nexiode' ),
							'sub_fields'   => array(
								array(
									'key'             => 'field_' . $key . '_store_locator_stores_items_name',
									'label'           => __( 'Name', 'nexiode' ),
									'name'            => 'name',
									'aria-label'      => __( 'Name', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the name of the item', 'nexiode' ),
									'default_value'   => '',
									'parent_repeater' => 'field_' . $key . '_store_locator_stores_items',
								),
								array(
									'key'             => 'field_' . $key . '_store_locator_stores_items_address',
									'label'           => __( 'Address', 'nexiode' ),
									'name'            => 'address',
									'aria-label'      => __( 'Address', 'nexiode' ),
									'type'            => 'text',
									'instructions'    => __( 'Enter the full address. Latitude and longitude will be filled automatically when you save.', 'nexiode' ),
									'placeholder'     => __( 'Enter the address of the item', 'nexiode' ),
									'default_value'   => '',
									'parent_repeater' => 'field_' . $key . '_store_locator_stores_items',
								),
								array(
									'key'             => 'field_' . $key . '_store_locator_stores_items_phone',
									'label'           => __( 'Phone', 'nexiode' ),
									'name'            => 'phone',
									'aria-label'      => __( 'Phone', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the phone of the item', 'nexiode' ),
									'default_value'   => '',
									'parent_repeater' => 'field_' . $key . '_store_locator_stores_items',
								),
								array(
									'key'             => 'field_' . $key . '_store_locator_stores_items_email',
									'label'           => __( 'Email', 'nexiode' ),
									'name'            => 'email',
									'aria-label'      => __( 'Email', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the email of the item', 'nexiode' ),
									'default_value'   => '',
									'parent_repeater' => 'field_' . $key . '_store_locator_stores_items',
								),
								array(
									'key'             => 'field_' . $key . '_store_locator_stores_items_coordinates',
									'label'           => __( 'Coordinates', 'nexiode' ),
									'name'            => 'coordinates',
									'aria-label'      => __( 'Coordinates', 'nexiode' ),
									'type'            => 'group',
									'instructions'    => __( 'Filled automatically from the address when you save. You can also enter or edit these values manually if needed.', 'nexiode' ),
									'layout'          => 'block',
									'parent_repeater' => 'field_' . $key . '_store_locator_stores_items',
									'sub_fields'      => array(
										array(
											'key'         => 'field_' . $key . '_store_locator_stores_items_coordinates_latitude',
											'label'       => __( 'Latitude', 'nexiode' ),
											'name'        => 'latitude',
											'aria-label'  => __( 'Latitude', 'nexiode' ),
											'type'        => 'text',
											'placeholder' => __( 'Enter the latitude of the item', 'nexiode' ),
											'default_value' => '',
											'wrapper'     => array(
												'width' => 6 * 100 / 12,
											),
										),
										array(
											'key'         => 'field_' . $key . '_store_locator_stores_items_coordinates_longitude',
											'label'       => __( 'Longitude', 'nexiode' ),
											'name'        => 'longitude',
											'aria-label'  => __( 'Longitude', 'nexiode' ),
											'type'        => 'text',
											'placeholder' => __( 'Enter the longitude of the item', 'nexiode' ),
											'default_value' => '',
											'wrapper'     => array(
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
		);
	}
}
