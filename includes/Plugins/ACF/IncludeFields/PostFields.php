<?php
/**
 * Post Fields
 *
 * ACF group on the native post type: related posts.
 * Reading time comes from the cinq-wp-reading-time mu-plugin.
 * The body stays in the native editor (`post_content`). This is not a page-builder group.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields;

use WPCinquanteEtUn\Service;

/**
 * PostFields
 *
 * Loads advanced custom fields for journal posts.
 */
class PostFields implements Service {

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
		$key = 'post_fields';

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
				),
			),
		);

		$fields = array(
			array(
				'key'           => 'field_' . $key . '_related',
				'label'         => __( 'Related posts', 'wp-cinquante-et-un' ),
				'name'          => 'related',
				'aria-label'    => __( 'Related posts', 'wp-cinquante-et-un' ),
				'type'          => 'relationship',
				'post_type'     => array( 'post' ),
				'filters'       => array( 'search' ),
				'max'           => 3,
				'return_format' => 'id',
				'instructions'  => __( 'Up to three posts. Leave empty to show the latest posts instead.', 'wp-cinquante-et-un' ),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'                   => 'group_' . $key,
					'title'                 => __( 'Post', 'wp-cinquante-et-un' ),
					'fields'                => $fields,
					'location'              => $location,
					'position'              => 'side',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
				)
			);
		}
	}
}
