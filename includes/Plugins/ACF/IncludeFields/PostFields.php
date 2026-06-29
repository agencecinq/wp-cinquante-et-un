<?php // phpcs:ignore
/**
 * Post Fields
 *
 * @package WordPress
 * @subpackage Nexiode
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Service;

/**
 * Post Fields
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
	public function fields() {
		$key            = 'post';
		$hide_on_screen = array();
		$location       = array(
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
				'key'        => 'field_' . $key . '_general_tab',
				'label'      => __( 'General', 'nexiode' ),
				'name'       => 'general',
				'aria-label' => __( 'General', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_general',
				'label'      => __( 'General', 'nexiode' ),
				'name'       => 'general',
				'aria-label' => __( 'General', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'          => 'field_' . $key . '_general_subtitle',
						'label'        => __( 'Subtitle', 'nexiode' ),
						'name'         => 'subtitle',
						'aria-label'   => __( 'Subtitle', 'nexiode' ),
						'type'         => 'text',
						'placeholder'  => __( 'Enter the subtitle of the post', 'nexiode' ),
						'instructions' => __( 'Short post subtitle.', 'nexiode' ) . ' <em>(' . __( 'Optional.', 'nexiode' ) . ')</em>',
					),
					array(
						'key'        => 'field_' . $key . '_general_learn_more',
						'label'      => __( 'Learn more', 'nexiode' ),
						'name'       => 'learn_more',
						'aria-label' => __( 'Learn more', 'nexiode' ),
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_general_learn_more_title',
								'label'        => __( 'Title', 'nexiode' ),
								'name'         => 'title',
								'aria-label'   => __( 'Title', 'nexiode' ),
								'type'         => 'text',
								'placeholder'  => __( 'Enter the title of the learn more', 'nexiode' ),
								'instructions' => __( 'The title of the learn more.', 'nexiode' ),
							),
							array(
								'key'          => 'field_' . $key . '_general_learn_more_text',
								'label'        => __( 'Text', 'nexiode' ),
								'name'         => 'text',
								'aria-label'   => __( 'Text', 'nexiode' ),
								'type'         => 'text',
								'placeholder'  => __( 'Enter the text of the learn more', 'nexiode' ),
								'instructions' => __( 'The text of the learn more.', 'nexiode' ),
							),
						),
					),
				),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group(
				array(
					'key'      => 'group_' . $key,
					'title'    => __( 'Post Fields', 'nexiode' ),
					'fields'   => $fields,
					'location' => $location,
				)
			);

		}
	}
}
