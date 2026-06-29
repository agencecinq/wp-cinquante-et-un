<?php
/**
 * ACF layout: LatestPosts
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * LatestPosts block layout.
 */
class LatestPosts {

	/**
	 * Returns the layout array for the LatestPosts block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_posts').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_latest_posts',
			'name'       => 'latest_posts',
			'label'      => __( 'Latest Posts', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_latest_posts' ),
				array(
					'key'        => 'field_' . $key . '_latest_posts_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'        => 'field_' . $key . '_latest_posts_content',
					'label'      => __( 'Content', 'nexiode' ),
					'name'       => 'content',
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_' . $key . '_latest_posts_content_overline',
							'label'        => __( 'Overline', 'nexiode' ),
							'name'         => 'overline',
							'aria-label'   => __( 'Overline', 'nexiode' ),
							'type'         => 'text',
							'placeholder'  => __( 'Enter the overline of the block', 'nexiode' ),
							'instructions' => __( 'Small label above the title.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
						),
						array(
							'key'           => 'field_' . $key . '_latest_posts_content_title',
							'label'         => __( 'Title', 'nexiode' ),
							'name'          => 'title',
							'aria-label'    => __( 'Title', 'nexiode' ),
							'type'          => 'text',
							'placeholder'   => __( 'Enter the title of the block', 'nexiode' ),
							'instructions'  => __( 'Section heading displayed above the posts list.', 'nexiode' ),
							'default_value' => '',
						),
						array(
							'key'          => 'field_' . $key . '_latest_posts_content_category',
							'label'        => __( 'Category', 'nexiode' ),
							'name'         => 'category',
							'aria-label'   => __( 'Category', 'nexiode' ),
							'type'         => 'taxonomy',
							'taxonomy'     => 'category',
							'multiple'     => 1,
							'instructions' => __( 'Leave empty to show latest posts from all categories.', 'nexiode' ),
						),
					),
				),
			),
		);
	}
}
