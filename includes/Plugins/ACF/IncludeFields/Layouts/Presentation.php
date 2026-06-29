<?php
/**
 * ACF layout: Presentation
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Presentation block layout.
 */
class Presentation {

	/**
	 * Returns the layout array for the Presentation block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_presentation',
			'name'       => 'presentation',
			'label'      => __( 'Presentation', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_presentation' ),
				AcfFieldHelpers::radius( $key . '_presentation' ),
				array(
					'key'        => 'field_' . $key . '_presentation_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_presentation_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_presentation_content_breadcrumb',
							'label'         => __( 'Breadcrumb', 'nexiode' ),
							'name'          => 'breadcrumb',
							'aria-label'    => __( 'Breadcrumb', 'nexiode' ),
							'type'          => 'true_false',
							'default_value' => false,
							'instructions'  => __( 'Show the breadcrumb of the page.', 'nexiode' ),
						),
						array(
							'key'          => 'field_' . $key . '_presentation_content_title',
							'label'        => __( 'Title', 'nexiode' ),
							'name'         => 'title',
							'aria-label'   => __( 'Title', 'nexiode' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the title of the content', 'nexiode' ),
							'instructions' => __( 'Will use the page title if not set.', 'nexiode' ),
						),
						array(
							'key'        => 'field_' . $key . '_presentation_content_heading',
							'label'      => __( 'Heading', 'nexiode' ),
							'name'       => 'heading',
							'aria-label' => __( 'Heading', 'nexiode' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_heading' ),
							'layout'     => 'block',
							'display'    => 'seamless',
						),
						array(
							'key'         => 'field_' . $key . '_presentation_content_subtitle',
							'label'       => __( 'Subtitle', 'nexiode' ),
							'name'        => 'subtitle',
							'aria-label'  => __( 'Subtitle', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the subtitle of the content', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_presentation_content_text',
							'label'       => __( 'Text', 'nexiode' ),
							'name'        => 'text',
							'aria-label'  => __( 'Text', 'nexiode' ),
							'type'        => 'textarea',
							'rows'        => 4,
							'new_lines'   => 'br',
							'placeholder' => __( 'Enter the text of the content', 'nexiode' ),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_presentation_tab_links',
					'label'      => __( 'Links', 'nexiode' ),
					'aria-label' => __( 'Links', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'          => 'field_' . $key . '_presentation_links',
					'label'        => __( 'Links', 'nexiode' ),
					'name'         => 'links',
					'aria-label'   => __( 'Links', 'nexiode' ),
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => __( 'Add Link', 'nexiode' ),
					'sub_fields'   => array(
						array(
							'key'        => 'field_' . $key . '_presentation_links_link',
							'label'      => __( 'Link', 'nexiode' ),
							'name'       => 'link',
							'aria-label' => __( 'Link', 'nexiode' ),
							'type'       => 'link',
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_presentation_tab_items',
					'label'      => __( 'Items', 'nexiode' ),
					'aria-label' => __( 'Items', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'          => 'field_' . $key . '_presentation_items',
					'label'        => __( 'Items', 'nexiode' ),
					'name'         => 'items',
					'aria-label'   => __( 'Items', 'nexiode' ),
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => __( 'Add Item', 'nexiode' ),
					'sub_fields'   => array(
						array(
							'key'             => 'field_' . $key . '_presentation_items_title',
							'label'           => __( 'Title', 'nexiode' ),
							'name'            => 'title',
							'aria-label'      => __( 'Title', 'nexiode' ),
							'type'            => 'text',
							'placeholder'     => __( 'Enter the title of the item', 'nexiode' ),
							'parent_repeater' => 'field_' . $key . '_presentation_items',
						),
						array(
							'key'             => 'field_' . $key . '_presentation_items_text',
							'label'           => __( 'Text', 'nexiode' ),
							'name'            => 'text',
							'aria-label'      => __( 'Text', 'nexiode' ),
							'type'            => 'textarea',
							'rows'            => 4,
							'new_lines'       => 'br',
							'placeholder'     => __( 'Enter the text of the item', 'nexiode' ),
							'parent_repeater' => 'field_' . $key . '_presentation_items',
						),
					),
				),
			),
		);
	}
}
