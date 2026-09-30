<?php
/**
 * ACF field helper functions
 *
 * Reusable ACF field arrays for flexible layouts (layout settings, media, heading).
 * Auto-loaded via composer.json "files" (Plugins/ACF/helpers.php).
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

/**
 * Shared spacing select choices (section top / bottom).
 *
 * Values are semantic keys mapped to Tailwind utilities in Twig / FormatValue.
 *
 * @return array<string, string>
 */
function cinq_acf_spacings(): array {
	return array(
		'none' => __( 'None', 'wp-cinquante-et-un' ),
		'sm'   => __( 'Small', 'wp-cinquante-et-un' ),
		'md'   => __( 'Medium', 'wp-cinquante-et-un' ),
		'lg'   => __( 'Large', 'wp-cinquante-et-un' ),
		'xl'   => __( 'Extra large', 'wp-cinquante-et-un' ),
	);
}

/**
 * Settings tab + layout group.
 *
 * Outer field key stays `field_settings_{$key}_layout` (name `layout`).
 *
 * @param string               $key  Block key prefix.
 * @param array<string, mixed> $args Optional layout group field overrides.
 * @return array<int, array<string, mixed>>
 */
function cinq_acf_settings_group( string $key, array $args = array() ): array {
	$group_key  = 'settings_' . $key . '_layout';
	$spacings   = cinq_acf_spacings();
	$sub_fields = array(
		array(
			'key'           => 'field_' . $group_key . '_color_scheme',
			'label'         => __( 'Color scheme', 'wp-cinquante-et-un' ),
			'name'          => 'color_scheme',
			'aria-label'    => __( 'Color scheme', 'wp-cinquante-et-un' ),
			'type'          => 'select',
			'instructions'  => __( 'Light (default) or inverse section colors.', 'wp-cinquante-et-un' ),
			'choices'       => array(
				'default' => __( 'Light', 'wp-cinquante-et-un' ),
				'inverse' => __( 'Inverse', 'wp-cinquante-et-un' ),
			),
			'default_value' => 'default',
			'return_format' => 'value',
		),
		array(
			'key'           => 'field_' . $group_key . '_spacing_top',
			'label'         => __( 'Spacing top', 'wp-cinquante-et-un' ),
			'name'          => 'spacing_top',
			'aria-label'    => __( 'Spacing top', 'wp-cinquante-et-un' ),
			'type'          => 'select',
			'instructions'  => __( 'Section spacing. Desktop / mobile: none 0/0, sm 32/24, md 64/40, lg 96/56, xl 128/72.', 'wp-cinquante-et-un' ),
			'choices'       => $spacings,
			'default_value' => 'md',
			'return_format' => 'value',
			'wrapper'       => array(
				'width' => 6 * 100 / 12,
			),
		),
		array(
			'key'           => 'field_' . $group_key . '_spacing_bottom',
			'label'         => __( 'Spacing bottom', 'wp-cinquante-et-un' ),
			'name'          => 'spacing_bottom',
			'aria-label'    => __( 'Spacing bottom', 'wp-cinquante-et-un' ),
			'type'          => 'select',
			'instructions'  => __( 'Section spacing. Desktop / mobile: none 0/0, sm 32/24, md 64/40, lg 96/56, xl 128/72.', 'wp-cinquante-et-un' ),
			'choices'       => $spacings,
			'default_value' => 'md',
			'return_format' => 'value',
			'wrapper'       => array(
				'width' => 6 * 100 / 12,
			),
		),
		array(
			'key'          => 'field_' . $group_key . '_anchor',
			'label'        => __( 'Anchor', 'wp-cinquante-et-un' ),
			'name'         => 'anchor',
			'aria-label'   => __( 'Anchor', 'wp-cinquante-et-un' ),
			'type'         => 'text',
			'instructions' => __( 'Optional section ID slug for in-page links (e.g. contact).', 'wp-cinquante-et-un' ) . ' <em>(' . __( 'Optional', 'wp-cinquante-et-un' ) . ')</em>.',
		),
		array(
			'key'           => 'field_' . $group_key . '_container',
			'label'         => __( 'Container', 'wp-cinquante-et-un' ),
			'name'          => 'container',
			'aria-label'    => __( 'Container', 'wp-cinquante-et-un' ),
			'type'          => 'select',
			'instructions'  => __( 'Default 1440px, wide 1760px, or full width without a container.', 'wp-cinquante-et-un' ),
			'choices'       => array(
				'default' => __( 'Default (1440px)', 'wp-cinquante-et-un' ),
				'wide'    => __( 'Wide (1760px)', 'wp-cinquante-et-un' ),
				'full'    => __( 'Full width', 'wp-cinquante-et-un' ),
			),
			'default_value' => 'default',
			'return_format' => 'value',
		),
	);

	$field = wp_parse_args(
		$args,
		array(
			'key'          => 'field_settings_' . $key . '_layout',
			'label'        => __( 'Layout', 'wp-cinquante-et-un' ),
			'name'         => 'layout',
			'aria-label'   => __( 'Layout', 'wp-cinquante-et-un' ),
			'type'         => 'group',
			'instructions' => __( 'Layout settings for the block.', 'wp-cinquante-et-un' ),
			'layout'       => 'block',
			'sub_fields'   => $sub_fields,
		)
	);

	return array(
		array(
			'key'        => 'field_settings_' . $key . '_tab_settings',
			'label'      => __( 'Settings', 'wp-cinquante-et-un' ),
			'aria-label' => __( 'Settings', 'wp-cinquante-et-un' ),
			'type'       => 'tab',
		),
		$field,
	);
}

/**
 * Media tab + group field.
 *
 * Outer field key stays `field_{$key}_media` (name `media`).
 *
 * @param string               $key  The key prefix (e.g. 'hero', 'blocks_hero').
 * @param array<string, mixed> $args Optional media group field overrides (e.g. instructions).
 * @return array<int, array<string, mixed>>
 */
function cinq_acf_media_group( string $key = '', array $args = array() ): array {
	$group_key = $key . '_media';

	$field = wp_parse_args(
		$args,
		array(
			'key'          => 'field_' . $key . '_media',
			'label'        => __( 'Media', 'wp-cinquante-et-un' ),
			'name'         => 'media',
			'aria-label'   => __( 'Media', 'wp-cinquante-et-un' ),
			'type'         => 'group',
			'instructions' => __( 'The video will take precedence over the image if both are filled.', 'wp-cinquante-et-un' ),
			'layout'       => 'block',
			'sub_fields'   => array(
				array(
					'key'        => 'field_' . $group_key . '_video',
					'label'      => __( 'Video', 'wp-cinquante-et-un' ),
					'name'       => 'video',
					'aria-label' => __( 'Video', 'wp-cinquante-et-un' ),
					'type'       => 'group',
					'layout'     => 'block',
					'wrapper'    => array(
						'width' => 6 * 100 / 12,
					),
					'sub_fields' => array(
						array(
							'key'           => 'field_' . $group_key . '_video_file',
							'label'         => __( 'File', 'wp-cinquante-et-un' ),
							'name'          => 'file',
							'aria-label'    => __( 'File', 'wp-cinquante-et-un' ),
							'type'          => 'file',
							'instructions'  => __( 'Supported formats: mp4, mpeg, avi, ogv, webm, and 3gp.', 'wp-cinquante-et-un' ),
							'return_format' => 'array',
							'library'       => 'all',
							'mime_types'    => 'mp4,mpeg,avi,ogv,webm,3gp',
						),
						array(
							'key'           => 'field_' . $group_key . '_video_poster',
							'label'         => __( 'Poster', 'wp-cinquante-et-un' ),
							'name'          => 'poster',
							'aria-label'    => __( 'Poster', 'wp-cinquante-et-un' ),
							'type'          => 'image',
							'instructions'  => __( 'Poster image for the video.', 'wp-cinquante-et-un' ),
							'return_format' => 'array',
							'library'       => 'all',
							'preview_size'  => 'medium',
						),
					),
				),
				array(
					'key'          => 'field_' . $group_key . '_images',
					'label'        => __( 'Image', 'wp-cinquante-et-un' ),
					'name'         => 'images',
					'aria-label'   => __( 'Image', 'wp-cinquante-et-un' ),
					'type'         => 'group',
					'instructions' => __( 'If only one image is provided, it will be used for both desktop and mobile whatever the screen size. If both desktop and mobile images are provided, the desktop image will be used for screens larger than 1024px and the mobile image for screens smaller than 1024px.', 'wp-cinquante-et-un' ),
					'layout'       => 'block',
					'wrapper'      => array(
						'width' => 6 * 100 / 12,
					),
					'sub_fields'   => array(
						array(
							'key'           => 'field_' . $group_key . '_images_0',
							'label'         => __( 'Mobile', 'wp-cinquante-et-un' ),
							'name'          => 0,
							'aria-label'    => __( 'Mobile', 'wp-cinquante-et-un' ),
							'type'          => 'image',
							'instructions'  => __( 'Mobile image for the block.', 'wp-cinquante-et-un' ),
							'return_format' => 'id',
							'library'       => 'all',
							'preview_size'  => 'medium',
						),
						array(
							'key'           => 'field_' . $group_key . '_images_1',
							'label'         => __( 'Desktop', 'wp-cinquante-et-un' ),
							'name'          => 1,
							'aria-label'    => __( 'Desktop', 'wp-cinquante-et-un' ),
							'type'          => 'image',
							'instructions'  => __( 'Desktop image for the block.', 'wp-cinquante-et-un' ),
							'return_format' => 'id',
							'library'       => 'all',
							'preview_size'  => 'medium',
						),
					),
				),
			),
		)
	);

	return array(
		array(
			'key'        => 'field_' . $key . '_tab_media',
			'label'      => __( 'Media', 'wp-cinquante-et-un' ),
			'aria-label' => __( 'Media', 'wp-cinquante-et-un' ),
			'type'       => 'tab',
		),
		$field,
	);
}

/**
 * Semantic heading level select (h1 / h2 / h3).
 *
 * @param string $key Field key prefix (e.g. `blocks_hero_content`).
 * @return array<string, mixed>
 */
function cinq_acf_heading( string $key = '' ): array {
	return array(
		'key'           => 'field_' . $key . '_heading',
		'label'         => __( 'Heading', 'wp-cinquante-et-un' ),
		'name'          => 'heading',
		'aria-label'    => __( 'Heading', 'wp-cinquante-et-un' ),
		'type'          => 'select',
		'instructions'  => __( 'Choose the heading level for the title of the block. It is important to use heading levels in a hierarchical way for accessibility and SEO reasons.', 'wp-cinquante-et-un' ),
		'choices'       => array(
			'h1' => __( 'H1', 'wp-cinquante-et-un' ),
			'h2' => __( 'H2', 'wp-cinquante-et-un' ),
			'h3' => __( 'H3', 'wp-cinquante-et-un' ),
		),
		'default_value' => 'h2',
		'return_format' => 'value',
	);
}

/**
 * Text alignment select (Tailwind utility class values).
 *
 * @param string $key Field key prefix.
 * @return array<string, mixed>
 */
function cinq_acf_text_alignment( string $key = '' ): array {
	return array(
		'key'           => 'field_' . $key . '_text_alignment',
		'label'         => __( 'Text Alignment', 'wp-cinquante-et-un' ),
		'name'          => 'text_alignment',
		'aria-label'    => __( 'Text Alignment', 'wp-cinquante-et-un' ),
		'type'          => 'select',
		'instructions'  => __( 'Choose the text alignment for the block.', 'wp-cinquante-et-un' ),
		'choices'       => array(
			'text-left'   => __( 'Left', 'wp-cinquante-et-un' ),
			'text-center' => __( 'Center', 'wp-cinquante-et-un' ),
			'text-right'  => __( 'Right', 'wp-cinquante-et-un' ),
		),
		'default_value' => 'text-left',
		'return_format' => 'value',
	);
}

/**
 * Builds the layouts array for a flexible content from layout classes.
 * Each class must have a static get_layout( string $key ): array returning keys 'key', 'name', 'label', 'display', 'sub_fields'.
 *
 * @param string $key            The field key prefix (e.g. 'blocks' or 'archive_posts').
 * @param array  $layout_classes Array of layout class names (class-string).
 * @return array<string, array<string, mixed>>
 */
function cinq_acf_layouts_from( string $key, array $layout_classes ): array {
	$layouts = array();

	foreach ( $layout_classes as $class ) {
		if ( is_callable( array( $class, 'get_layout' ) ) ) {
			$layout                                    = $class::get_layout( $key );
			$name                                      = $layout['name'] ?? '';
			$layouts[ 'layout_' . $key . '_' . $name ] = $layout;
		}
	}

	return $layouts;
}
