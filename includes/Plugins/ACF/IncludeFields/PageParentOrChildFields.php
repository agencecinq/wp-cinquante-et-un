<?php
/**
 * PageParentOrChildFields
 *
 * Registers ACF field group for pages that have a parent and/or at least one child.
 *
 * @package Nexiode
 * @subpackage Nexiode/Plugins/ACF/IncludeFields
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Service;

/**
 * Page Parent Or Child Fields
 *
 * Loads advanced custom fields for pages that have a parent OR at least one child.
 */
class PageParentOrChildFields implements Service {

	/**
	 * Register ACF field group include for pages with parent or children.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields(): void {
		$key            = 'page_parent_or_child';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'parent',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'child',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key . '_general_tab',
				'label'      => __( 'General', 'nexiode' ),
				'aria-label' => __( 'General', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'          => 'field_' . $key . '_general',
				'label'        => __( 'General', 'nexiode' ),
				'name'         => 'general',
				'aria-label'   => __( 'General', 'nexiode' ),
				'type'         => 'group',
				'instructions' => __( 'General settings for the page.', 'nexiode' ),
				'layout'       => 'block',
				'sub_fields'   => array(
					array(
						'key'          => 'field_' . $key . '_general_title',
						'label'        => __( 'Title', 'nexiode' ),
						'name'         => 'title',
						'aria-label'   => __( 'Title', 'nexiode' ),
						'type'         => 'text',
						'placeholder'  => __( 'Page title', 'nexiode' ),
						'instructions' => __( 'Enter the title of the page. Will be used as the page title.', 'nexiode' ),
					),
					array(
						'key'          => 'field_' . $key . '_general_headline',
						'label'        => __( 'Headline', 'nexiode' ),
						'name'         => 'headline',
						'aria-label'   => __( 'Headline', 'nexiode' ),
						'type'         => 'text',
						'placeholder'  => __( 'Page headline', 'nexiode' ),
						'instructions' => __( 'Enter the headline of the page. Will be used as the page headline in the tease page block for instance. If empty, the page title will be used.', 'nexiode' ),
					),
				),
			),
			...AcfFieldHelpers::media( $key ),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'        => 'group_' . $key,
					'title'      => __( 'Page Parent Or Child Fields', 'nexiode' ),
					'fields'     => $fields,
					'location'   => $location,
					'menu_order' => 1,
				)
			);
		}
	}
}
