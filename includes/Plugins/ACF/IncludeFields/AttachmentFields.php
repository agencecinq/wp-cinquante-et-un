<?php
/**
 * Attachment Fields
 *
 * ACF group on images in the media library: framing kept when a block crops
 * the image to its frame (`object-position`, read by components/image.html.twig).
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields;

use WPCinquanteEtUn\Service;

/**
 * AttachmentFields
 *
 * Loads advanced custom fields for image attachments.
 */
class AttachmentFields implements Service {

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
	public function fields(): void {
		$key = 'attachment_fields';

		$location = array(
			array(
				array(
					'param'    => 'attachment',
					'operator' => '==',
					'value'    => 'image',
				),
			),
		);

		$fields = array(
			array(
				'key'           => 'field_' . $key . '_focal_point',
				'label'         => __( 'Framing', 'wp-cinquante-et-un' ),
				'name'          => 'focal_point',
				'aria-label'    => __( 'Framing', 'wp-cinquante-et-un' ),
				'type'          => 'select',
				'choices'       => array(
					'center'       => __( 'Center', 'wp-cinquante-et-un' ),
					'top'          => __( 'Top', 'wp-cinquante-et-un' ),
					'bottom'       => __( 'Bottom', 'wp-cinquante-et-un' ),
					'left'         => __( 'Left', 'wp-cinquante-et-un' ),
					'right'        => __( 'Right', 'wp-cinquante-et-un' ),
					'top left'     => __( 'Top left', 'wp-cinquante-et-un' ),
					'top right'    => __( 'Top right', 'wp-cinquante-et-un' ),
					'bottom left'  => __( 'Bottom left', 'wp-cinquante-et-un' ),
					'bottom right' => __( 'Bottom right', 'wp-cinquante-et-un' ),
				),
				'default_value' => 'center',
				'return_format' => 'value',
				'instructions'  => __( 'Part of the image kept visible when a block crops it to its frame.', 'wp-cinquante-et-un' ),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'                   => 'group_' . $key,
					'title'                 => __( 'Image', 'wp-cinquante-et-un' ),
					'fields'                => $fields,
					'location'              => $location,
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
				)
			);
		}
	}
}
