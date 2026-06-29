<?php
/**
 * ACF layout: AccordionGroup
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * AccordionGroup block layout.
 */
class AccordionGroup {

	/**
	 * Returns the layout array for the AccordionGroup block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_accordion_group',
			'name'       => 'accordion_group',
			'label'      => __( 'Accordion Group', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_accordion_group' ),
				AcfFieldHelpers::radius( $key . '_accordion_group' ),
				array(
					'key'        => 'field_' . $key . '_accordion_group_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_accordion_group_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_accordion_group_content_overline',
							'label'         => __( 'Overline', 'nexiode' ),
							'name'          => 'overline',
							'aria-label'    => __( 'Overline', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Overline of the block', 'nexiode' ),
							'instructions'  => __( 'Optional text shown above the main title.', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'           => 'field_' . $key . '_accordion_group_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Title of the block', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'        => 'field_' . $key . '_accordion_group_content_contact',
							'label'      => __( 'Contact', 'nexiode' ),
							'name'       => 'contact',
							'aria-label' => __( 'Contact', 'nexiode' ),
							'type'       => 'group',
							'layout'     => 'block',
							'sub_fields' => array(

								array(
									'key'           => 'field_' . $key . '_accordion_group_content_contact_image',
									'label'         => __( 'Image', 'nexiode' ),
									'name'          => 'image',
									'aria-label'    => __( 'Image', 'nexiode' ),
									'instructions'  => __( 'Select or upload an image.', 'nexiode' ),
									'type'          => 'image',
									'return_format' => 'id',
								),
								array(
									'key'           => 'field_' . $key . '_accordion_group_content_contact_title',
									'label'         => __( 'Title', 'nexiode' ),
									'name'          => 'title',
									'aria-label'    => __( 'Title', 'nexiode' ),
									'type'          => 'text',
									'placeholder'   => __( 'Title of the contact', 'nexiode' ),
									'instructions'  => __( 'Contact name or title.', 'nexiode' ),
									'default_value' => '',
								),
								array(
									'key'           => 'field_' . $key . '_accordion_group_content_contact_text',
									'label'         => __( 'Text', 'nexiode' ),
									'name'          => 'text',
									'aria-label'    => __( 'Text', 'nexiode' ),
									'instructions'  => __( 'Short description or bio.', 'nexiode' ),
									'default_value' => '',
									'placeholder'   => __( 'Text of the contact', 'nexiode' ),
									'type'          => 'textarea',
									'rows'          => 2,
								),
								array(
									'key'          => 'field_' . $key . '_accordion_group_content_contact_link',
									'label'        => __( 'Link', 'nexiode' ),
									'name'         => 'link',
									'aria-label'   => __( 'Link', 'nexiode' ),
									'type'         => 'link',
									'instructions' => __( 'Enter the link URL.', 'nexiode' ),
								),
							),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_accordion_group_tab_accordions',
					'label'      => __( 'Accordions', 'nexiode' ),
					'aria-label' => __( 'Accordions', 'nexiode' ),
					'type'       => 'tab',
				),
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
		);
	}
}
