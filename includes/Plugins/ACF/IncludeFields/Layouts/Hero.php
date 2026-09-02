<?php
/**
 * ACF layout: Hero
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields/Layouts
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Hero block layout.
 */
class Hero {

	/**
	 * Returns the layout array for the Hero block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_hero',
			'name'       => 'hero',
			'label'      => __( 'Hero', 'wp-cinquante-et-un' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_hero' ),
				array(
					'key'           => 'field_' . $key . '_hero_show_media_overlay',
					'label'         => __( 'Media overlay', 'wp-cinquante-et-un' ),
					'name'          => 'show_media_overlay',
					'aria-label'    => __( 'Media overlay', 'wp-cinquante-et-un' ),
					'type'          => 'true_false',
					'default_value' => 0,
					'ui'            => 1,
					'instructions'  => __( 'Darken the media from top to bottom.', 'wp-cinquante-et-un' ),
				),
				...AcfFieldHelpers::media( $key . '_hero' ),
				array(
					'key'        => 'field_' . $key . '_hero_content_tab',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_hero_content',
					'label'      => __( 'Content', 'wp-cinquante-et-un' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_hero_content_overline',
							'label'        => __( 'Overline', 'wp-cinquante-et-un' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'wp-cinquante-et-un' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'wp-cinquante-et-un' ),
							'instructions' => __( 'Small label above the title.', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_hero_content_title',
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
							'key'        => 'field_' . $key . '_hero_content_heading',
							'label'      => __( 'Heading', 'wp-cinquante-et-un' ),
							'name'       => 'heading',
							'aria-label' => __( 'Heading', 'wp-cinquante-et-un' ),
							'type'       => 'clone',
							'clone'      => array( 'field_clones_heading' ),
							'display'    => 'seamless',
							'layout'     => 'block',
						),
						array(
							'key'           => 'field_' . $key . '_hero_content_text',
							'label'         => __( 'Text', 'wp-cinquante-et-un' ),
							'name'          => 'text',
							'aria-label'    => __( 'Text', 'wp-cinquante-et-un' ),
							'type'          => 'textarea',
							'rows'          => 3,
							'new_lines'     => 'br',
							'placeholder'   => __( 'Enter the text of the block', 'wp-cinquante-et-un' ),
							'default_value' => '',
						),
						array(
							'key'         => 'field_' . $key . '_hero_content_link',
							'label'       => __( 'Primary link', 'wp-cinquante-et-un' ),
							'name'        => 'link',
							'aria-label'  => __( 'Primary link', 'wp-cinquante-et-un' ),
							'type'        => 'link',
							'placeholder' => __( 'Enter the URL of the link', 'wp-cinquante-et-un' ),
							'wrapper'     => array(
								'width' => 50,
							),
						),
						array(
							'key'         => 'field_' . $key . '_hero_content_secondary_link',
							'label'       => __( 'Secondary link', 'wp-cinquante-et-un' ),
							'name'        => 'secondary_link',
							'aria-label'  => __( 'Secondary link', 'wp-cinquante-et-un' ),
							'type'        => 'link',
							'placeholder' => __( 'Enter the URL of the link', 'wp-cinquante-et-un' ),
							'wrapper'     => array(
								'width' => 50,
							),
						),
					),
				),
			),
		);
	}
}
