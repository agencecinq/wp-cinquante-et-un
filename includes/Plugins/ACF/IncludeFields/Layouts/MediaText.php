<?php
/**
 * ACF layout: MediaText
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * MediaText block layout.
 */
class MediaText {

	/**
	 * Returns the layout array for the MediaText block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_media_text',
			'name'       => 'media_text',
			'label'      => __( 'Media Text', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_media_text' ),
				array(
					'key'           => 'field_' . $key . '_media_text_reveal_on_scroll',
					'label'         => __( 'Reveal on Scroll', 'nexiode' ),
					'name'          => 'reveal_on_scroll',
					'aria-label'    => __( 'Reveal on Scroll', 'nexiode' ),
					'type'          => 'true_false',
					'default_value' => 0,
					'instructions'  => __( 'Animate when the block scrolls into view.', 'nexiode' ),
				),
				...AcfFieldHelpers::media( $key . '_media_text' ),
				array(
					'key'        => 'field_' . $key . '_media_text_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_media_text_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $key . '_media_text_content_title',
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
							'key'        => 'field_' . $key . '_media_text_content_heading',
							'label'      => __( 'Heading', 'nexiode' ),
							'name'       => 'heading',
							'aria-label' => __( 'Heading', 'nexiode' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_heading' ),
							'display'    => 'seamless',
							'layout'     => 'block',
						),
						array(
							'key'          => 'field_' . $key . '_media_text_content_title_style',
							'label'        => __( 'Title Style', 'nexiode' ),
							'name'         => 'title_style',
							'aria-label'   => __( 'Title Style', 'nexiode' ),
							'instructions' => __( 'Visual style only; does not change the heading level.', 'nexiode' ),
							'type'         => 'clone',
							'clone'        => array( 'field_clones_style' ),
							'layout'       => 'block',
							'display'      => 'seamless',
						),
					),
				),
			),
		);
	}
}
