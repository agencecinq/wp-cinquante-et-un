<?php
/**
 * ACF layout: Marquee
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Marquee block layout.
 */
class Marquee {

	/**
	 * Returns the layout array for the Marquee block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_marquee',
			'name'       => 'marquee',
			'label'      => __( 'Marquee', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_marquee' ),
				array(
					'key'           => 'field_' . $key . '_marquee_color_scheme',
					'label'         => __( 'Color Scheme', 'nexiode' ),
					'name'          => 'color_scheme',
					'aria-label'    => __( 'Color Scheme', 'nexiode' ),
					'type'          => 'select',
					'choices'       => array(
						'light' => __( 'Light', 'nexiode' ),
						'dark'  => __( 'Dark', 'nexiode' ),
					),
					'default_value' => 'light',
					'return_format' => 'value',
				),
				AcfFieldHelpers::radius( $key . '_marquee' ),
				array(
					'key'        => 'field_' . $key . '_marquee_tab_2',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_marquee_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_marquee_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'nexiode' ),
							'default_value' => '',
						),
					),
				),
			),
		);
	}
}
