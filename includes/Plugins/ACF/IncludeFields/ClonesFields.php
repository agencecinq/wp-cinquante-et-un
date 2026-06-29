<?php // phpcs:ignore
/**
 * Blocks Fields
 *
 * @package WordPress
 * @subpackage Nexiode
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Service;

/**
 * Clones Fields
 */
class ClonesFields implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields() {
		$key            = 'clones';
		$hide_on_screen = array();
		$location       = array();

		$fields = array(
			array(
				'key'          => 'field_' . $key . '_layout',
				'label'        => __( 'Layout', 'nexiode' ),
				'name'         => 'layout',
				'aria-label'   => __( 'Layout', 'nexiode' ),
				'type'         => 'group',
				'instructions' => __( 'Layout settings for the block.', 'nexiode' ),
				'layout'       => 'block',
				'sub_fields'   => array(
					array(
						'key'          => 'field_' . $key . '_layout_paddings',
						'label'        => __( 'Paddings', 'nexiode' ),
						'name'         => 'paddings',
						'aria-label'   => __( 'Paddings', 'nexiode' ),
						'type'         => 'group',
						'instructions' => __( 'Padding settings for the block on desktop. On mobile paddings are multiplied by 0.75.', 'nexiode' ) . '<br>' . __( "Don't forget to add extra padding on blocks that precede or follow by a rounded block.", 'nexiode' ),
						'layout'       => 'block',
						'sub_fields'   => array(
							array(
								'key'           => 'field_' . $key . '_layout_paddings_top',
								'label'         => __( 'Top', 'nexiode' ),
								'name'          => 'top',
								'aria-label'    => __( 'Top', 'nexiode' ),
								'type'          => 'number',
								'instructions'  => __( 'Top padding in pixels', 'nexiode' ),
								'default_value' => 80,
								'min'           => 0,
								'step'          => 1,
								'append'        => __( 'px', 'nexiode' ),
								'wrapper'       => array(
									'width' => 6 * 100 / 12,
								),
							),
							array(
								'key'           => 'field_' . $key . '_layout_paddings_bottom',
								'label'         => __( 'Bottom', 'nexiode' ),
								'name'          => 'bottom',
								'aria-label'    => __( 'Bottom', 'nexiode' ),
								'type'          => 'number',
								'instructions'  => __( 'Bottom padding in pixels', 'nexiode' ),
								'default_value' => 80,
								'min'           => 0,
								'step'          => 1,
								'append'        => __( 'px', 'nexiode' ),
								'wrapper'       => array(
									'width' => 6 * 100 / 12,
								),
							),
						),
					),
				),
			),
			array(
				'key'          => 'field_' . $key . '_media',
				'label'        => __( 'Media', 'nexiode' ),
				'name'         => 'media',
				'aria-label'   => __( 'Media', 'nexiode' ),
				'type'         => 'group',
				'instructions' => __( 'The video will take precedence over the image if both are filled.', 'nexiode' ),
				'layout'       => 'block',
				'sub_fields'   => array(
					array(
						'key'          => 'field_' . $key . '_media_video',
						'label'        => __( 'Video', 'nexiode' ),
						'name'         => 'video',
						'aria-label'   => __( 'Video', 'nexiode' ),
						'type'         => 'group',
						'instructions' => '',
						'layout'       => 'block',
						'wrapper'      => array(
							'width' => 6 * 100 / 12,
						),
						'sub_fields'   => array(
							array(
								'key'           => 'field_' . $key . '_media_video_file',
								'label'         => __( 'File', 'nexiode' ),
								'name'          => 'file',
								'aria-label'    => __( 'File', 'nexiode' ),
								'type'          => 'file',
								'instructions'  => __( 'Supported formats: mp4, mpeg, avi, ogv, webm, and 3gp.', 'nexiode' ),
								'return_format' => 'array',
								'library'       => 'all',
								'mime_types'    => 'mp4,mpeg,avi,ogv,webm,3gp',
							),
							array(
								'key'           => 'field_' . $key . '_media_video_poster',
								'label'         => __( 'Poster', 'nexiode' ),
								'name'          => 'poster',
								'aria-label'    => __( 'Poster', 'nexiode' ),
								'type'          => 'image',
								'instructions'  => __( 'Poster image for the video.', 'nexiode' ),
								'return_format' => 'array',
								'library'       => 'all',
								'preview_size'  => 'medium',
							),
						),
					),
					array(
						'key'          => 'field_' . $key . '_media_images',
						'label'        => __( 'Image', 'nexiode' ),
						'name'         => 'images',
						'aria-label'   => __( 'Image', 'nexiode' ),
						'type'         => 'group',
						'instructions' => __( 'If only one image is provided, it will be used for both desktop and mobile whatever the screen size. If both desktop and mobile images are provided, the desktop image will be used for screens larger than 1024px and the mobile image for screens smaller than 1024px.', 'nexiode' ),
						'layout'       => 'block',
						'wrapper'      => array(
							'width' => 6 * 100 / 12,
						),
						'sub_fields'   => array(
							array(
								'key'           => 'field_' . $key . '_media_images_0',
								'label'         => __( 'Mobile', 'nexiode' ),
								'name'          => 0,
								'aria-label'    => __( 'Mobile', 'nexiode' ),
								'type'          => 'image',
								'instructions'  => __( 'Mobile image for the block.', 'nexiode' ),
								'return_format' => 'id',
								'library'       => 'all',
								'preview_size'  => 'medium',
							),
							array(
								'key'           => 'field_' . $key . '_media_images_1',
								'label'         => __( 'Desktop', 'nexiode' ),
								'name'          => 1,
								'aria-label'    => __( 'Desktop', 'nexiode' ),
								'type'          => 'image',
								'instructions'  => __( 'Desktop image for the block.', 'nexiode' ),
								'return_format' => 'id',
								'library'       => 'all',
								'preview_size'  => 'medium',
							),
						),
					),
				),
			),
			array(
				'key'           => 'field_' . $key . '_heading',
				'label'         => __( 'Heading', 'nexiode' ),
				'name'          => 'heading',
				'aria-label'    => __( 'Heading', 'nexiode' ),
				'type'          => 'select',
				'instructions'  => __( 'Choose the heading level for the title of the block. It is important to use heading levels in a hierarchical way for accessibility and SEO reasons.', 'nexiode' ),
				'choices'       => array(
					'h1' => __( 'H1', 'nexiode' ),
					'h2' => __( 'H2', 'nexiode' ),
					'h3' => __( 'H3', 'nexiode' ),
				),
				'default_value' => 'h2',
				'return_format' => 'value',
			),
			array(
				'key'           => 'field_' . $key . '_style',
				'label'         => __( 'Title Style', 'nexiode' ),
				'name'          => 'title_style',
				'aria-label'    => __( 'Title Style', 'nexiode' ),
				'instructions'  => __( 'Visual style only; does not change the heading level.', 'nexiode' ),
				'type'          => 'select',
				'choices'       => array(
					'h1' => __( 'H1', 'nexiode' ),
					'h2' => __( 'H2', 'nexiode' ),
					'h3' => __( 'H3', 'nexiode' ),
					'h4' => __( 'H4', 'nexiode' ),
					'h5' => __( 'H5', 'nexiode' ),
				),
				'default_value' => 'h2',
				'return_format' => 'value',
			),
			array(
				'key'           => 'field_' . $key . '_text_alignment',
				'label'         => __( 'Text Alignment', 'nexiode' ),
				'name'          => 'text_alignment',
				'aria-label'    => __( 'Text Alignment', 'nexiode' ),
				'type'          => 'select',
				'instructions'  => __( 'Choose the text alignment for the block.', 'nexiode' ),
				'choices'       => array(
					'text-left'   => __( 'Left', 'nexiode' ),
					'text-center' => __( 'Center', 'nexiode' ),
					'text-right'  => __( 'Right', 'nexiode' ),
				),
				'default_value' => 'text-left',
				'return_format' => 'value',
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'      => 'group_' . $key,
					'title'    => __( 'Clones Fields', 'nexiode' ),
					'fields'   => $fields,
					'location' => $location,
					'active'   => false,
				)
			);

		}
	}
}
