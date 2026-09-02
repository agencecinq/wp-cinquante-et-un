<?php
/**
 * ACF layout: MediaText
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

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
			'label'      => __( 'Media Text', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_media_text' ),
				array(
					'key'           => 'field_' . $key . '_media_text_media_position',
					'label'         => __( 'Media position', 'wp-cinquante-et-un' ),
					'name'          => 'media_position',
					'aria-label'    => __( 'Media position', 'wp-cinquante-et-un' ),
					'type'          => 'select',
					'choices'       => array(
						'left'  => __( 'Left', 'wp-cinquante-et-un' ),
						'right' => __( 'Right', 'wp-cinquante-et-un' ),
					),
					'default_value' => 'left',
					'return_format' => 'value',
					'instructions'  => __( 'On small screens the media always stacks above the text.', 'wp-cinquante-et-un' ),
				),
				...AcfFieldHelpers::media( $key . '_media_text' ),
				array(
					'key'        => 'field_' . $key . '_media_text_tab_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_media_text_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_media_text_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_media_text_content_title',
							'label'         => __( 'Title', 'wp-cinquante-et-un' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'wp-cinquante-et-un' ),
							'type'          => 'textarea',
							'rows'          => 2,
							'new_lines'     => 'br',
							'placeholder'   => __( 'Enter the title of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'        => 'field_' . $key . '_media_text_content_heading',
							'label'      => __( 'Heading', 'wp-cinquante-et-un' ),
							'name'       => 'heading',
							'aria-label' => __( 'Heading', 'wp-cinquante-et-un' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_heading' ),
							'display'    => 'seamless',
							'layout'     => 'block',
						),
						array(
							'key'           => 'field_' . $key . '_media_text_content_text',
							'label'         => __( 'Text', 'wp-cinquante-et-un' ),
							'name'          => 'text',
							'aria-label'    => __( 'Text', 'wp-cinquante-et-un' ),
							'type'          => 'wysiwyg',
							'tabs'          => 'visual',
							'toolbar'       => 'basic',
							'media_upload'  => 0,
							'delay'         => 1,
						),
						array(
							'key'        => 'field_' . $key . '_media_text_content_link',
							'label'      => __( 'Link', 'wp-cinquante-et-un' ),
							'name'       => 'link',
							'aria-label' => __( 'Link', 'wp-cinquante-et-un' ),
							'type'       => 'link',
						),
					),
				),
			),
		);
	}
}
