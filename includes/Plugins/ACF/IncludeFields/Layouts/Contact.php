<?php
/**
 * ACF layout: Contact
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Contact block layout.
 */
class Contact {

	/**
	 * Returns the layout array for the Contact block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_contact',
			'name'       => 'contact',
			'label'      => __( 'Contact us', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_contact' ),
				...AcfFieldHelpers::media( $key . '_contact' ),
				array(
					'key'        => 'field_' . $key . '_contact_content_tab',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_contact_content',
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_contact_content_image',
							'label'         => __( 'Image', 'nexiode' ),
							'name'          => 'image',
							'aria-label'    => __( 'Image', 'nexiode' ),
							'type'          => 'image',
							'return_format' => 'id',
						),
						array(
							'key'         => 'field_' . $key . '_contact_content_title',
							'label'       => __( 'Title', 'nexiode' ),
							'name'        => 'title',
							'aria-label'  => __( 'Title', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the title', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_contact_content_text',
							'label'       => __( 'Text', 'nexiode' ),
							'name'        => 'text',
							'aria-label'  => __( 'Text', 'nexiode' ),
							'type'        => 'textarea',
							'rows'        => 4,
							'new_lines'   => 'br',
							'placeholder' => __( 'Enter the text', 'nexiode' ),
						),
						array(
							'key'        => 'field_' . $key . '_contact_content_link',
							'label'      => __( 'Link', 'nexiode' ),
							'name'       => 'link',
							'aria-label' => __( 'Link', 'nexiode' ),
							'type'       => 'link',
						),
					),
				),
			),
		);
	}
}
