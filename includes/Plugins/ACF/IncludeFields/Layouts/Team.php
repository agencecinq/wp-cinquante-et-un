<?php
/**
 * ACF layout: Team
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Team block layout.
 */
class Team {

	/**
	 * Returns the layout array for the Team block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_team',
			'name'       => 'team',
			'label'      => __( 'Team', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_team' ),
				array(
					'key'        => 'field_' . $key . '_team_content_tab',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_team_content',
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'        => 'field_' . $key . '_team_content_members',
							'label'      => __( 'Members', 'nexiode' ),
							'name'       => 'members',
							'aria-label' => __( 'Members', 'nexiode' ),
							'type'       => 'repeater',
							'layout'     => 'block',
							'sub_fields' => array(
								array(
									'key'             => 'field_' . $key . '_team_content_members_name',
									'label'           => __( 'Name', 'nexiode' ),
									'name'            => 'name',
									'aria-label'      => __( 'Name', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the name of the member', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_team_content_members',
								),
								array(
									'key'             => 'field_' . $key . '_team_content_members_position',
									'label'           => __( 'Position', 'nexiode' ),
									'name'            => 'position',
									'aria-label'      => __( 'Position', 'nexiode' ),
									'type'            => 'text',
									'placeholder'     => __( 'Enter the position of the member', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_team_content_members',
								),
								array(
									'key'               => 'field_' . $key . '_team_content_members_image',
									'label'             => __( 'Image', 'nexiode' ),
									'name'              => 'image',
									'aria-label'        => __( 'Image', 'nexiode' ),
									'type'              => 'image',
									'return_format'     => 'id',
									'library'           => 'all',
									'allow_in_bindings' => 0,
									'preview_size'      => 'medium',
									'parent_repeater'   => 'field_' . $key . '_team_content_members',
								),
								array(
									'key'             => 'field_' . $key . '_team_content_members_linkedin',
									'label'           => __( 'LinkedIn', 'nexiode' ),
									'name'            => 'linkedin',
									'aria-label'      => __( 'LinkedIn', 'nexiode' ),
									'type'            => 'url',
									'placeholder'     => __( 'Enter the LinkedIn URL of the member', 'nexiode' ),
									'parent_repeater' => 'field_' . $key . '_team_content_members',
								),
							),
						),
					),
				),
			),
		);
	}
}
