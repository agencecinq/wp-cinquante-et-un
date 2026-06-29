<?php
/**
 * ACF layout: Process
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Process block layout.
 */
class Process {

	/**
	 * Returns the layout array for the Process block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_process',
			'name'       => 'process',
			'label'      => __( 'Process', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_process' ),
				AcfFieldHelpers::radius( $key . '_process' ),
				array(
					'key'        => 'field_' . $key . '_process_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_process_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'         => 'field_' . $key . '_process_content_title',
							'label'       => __( 'Title', 'nexiode' ),
							'name'        => 'title',
							'aria-label'  => __( 'Title', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the title of the block', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_process_content_subtitle',
							'label'       => __( 'Subtitle', 'nexiode' ),
							'name'        => 'subtitle',
							'aria-label'  => __( 'Subtitle', 'nexiode' ),
							'type'        => 'text',
							'placeholder' => __( 'Enter the subtitle of the block', 'nexiode' ),
						),
						array(
							'key'         => 'field_' . $key . '_process_content_text',
							'label'       => __( 'Text', 'nexiode' ),
							'name'        => 'text',
							'aria-label'  => __( 'Text', 'nexiode' ),
							'type'        => 'textarea',
							'rows'        => 4,
							'new_lines'   => 'br',
							'placeholder' => __( 'Optional explanatory text (e.g. right column).', 'nexiode' ),
						),
					),
				),
				array(
					'key'        => 'field_' . $key . '_process_tab_steps',
					'label'      => __( 'Steps', 'nexiode' ),
					'aria-label' => __( 'Steps', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'          => 'field_' . $key . '_process_steps',
					'label'        => __( 'Steps', 'nexiode' ),
					'name'         => 'steps',
					'aria-label'   => __( 'Steps', 'nexiode' ),
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => __( 'Add Step', 'nexiode' ),
					'min'          => 1,
					'max'          => 6,
					'sub_fields'   => array(
						array(
							'key'             => 'field_' . $key . '_process_steps_image',
							'label'           => __( 'Image', 'nexiode' ),
							'name'            => 'image',
							'aria-label'      => __( 'Image', 'nexiode' ),
							'type'            => 'image',
							'return_format'   => 'array',
							'preview_size'    => 'medium',
							'parent_repeater' => 'field_' . $key . '_process_steps',
						),
						array(
							'key'             => 'field_' . $key . '_process_steps_title',
							'label'           => __( 'Title', 'nexiode' ),
							'name'            => 'title',
							'aria-label'      => __( 'Title', 'nexiode' ),
							'type'            => 'text',
							'placeholder'     => __( 'Enter the title of the step', 'nexiode' ),
							'parent_repeater' => 'field_' . $key . '_process_steps',
						),
						array(
							'key'             => 'field_' . $key . '_process_steps_text',
							'label'           => __( 'Text', 'nexiode' ),
							'name'            => 'text',
							'aria-label'      => __( 'Text', 'nexiode' ),
							'type'            => 'textarea',
							'rows'            => 3,
							'new_lines'       => 'br',
							'placeholder'     => __( 'Enter the description of the step', 'nexiode' ),
							'parent_repeater' => 'field_' . $key . '_process_steps',
						),
						array(
							'key'             => 'field_' . $key . '_process_steps_logos',
							'label'           => __( 'Logos', 'nexiode' ),
							'name'            => 'logos',
							'aria-label'      => __( 'Logos', 'nexiode' ),
							'type'            => 'gallery',
							'return_format'   => 'id',
							'preview_size'    => 'thumbnail',
							'parent_repeater' => 'field_' . $key . '_process_steps',
						),
						array(
							'key'             => 'field_' . $key . '_process_steps_link',
							'label'           => __( 'Link', 'nexiode' ),
							'name'            => 'link',
							'aria-label'      => __( 'Link', 'nexiode' ),
							'type'            => 'link',
							'parent_repeater' => 'field_' . $key . '_process_steps',
						),
					),
				),
			),
		);
	}
}
