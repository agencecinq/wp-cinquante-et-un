<?php
/**
 * Blocks Fields
 *
 * Registers ACF field group includes for blocks.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Plugins/ACF/IncludeFields
 */

namespace WPCinquanteEtUn\Plugins\ACF\IncludeFields;

use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\AccordionGroup;
use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\Columns;
use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\Form;
use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\Gallery;
use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\Hero;
use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\LatestPosts;
use WPCinquanteEtUn\Plugins\ACF\IncludeFields\Layouts\MediaText;
use WPCinquanteEtUn\Service;

/**
 * Blocks Fields
 *
 * Loads advanced custom fields for blocks.
 */
class BlocksFields implements Service {

	/**
	 * Kernel layout classes for the blocks field. Order = display order.
	 *
	 * @var array<int, class-string>
	 */
	private static $layouts = array(
		AccordionGroup::class,
		Columns::class,
		Form::class,
		Gallery::class,
		Hero::class,
		LatestPosts::class,
		MediaText::class,
	);

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
		$key            = 'blocks';
		$hide_on_screen = array();

		$location = array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
				array(
					'param'    => 'page_template',
					'operator' => '!=',
					'value'    => 'page-templates/styleguide-page.php',
				),
			),
		);

		$fields = array(
			array(
				'key'          => 'field_' . $key,
				'label'        => __( 'Blocks', 'wp-cinquante-et-un' ),
				'name'         => 'blocks',
				'aria-label'   => __( 'Blocks', 'wp-cinquante-et-un' ),
				'type'         => 'flexible_content',
				'instructions' => __( 'Add and arrange blocks to build the page content.', 'wp-cinquante-et-un' ),
				'layouts'      => AcfFieldHelpers::get_layouts_from( $key, self::$layouts ),
				'button_label' => __( 'Add Block', 'wp-cinquante-et-un' ),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'        => 'group_' . $key,
					'title'      => __( 'Blocks Fields', 'wp-cinquante-et-un' ),
					'fields'     => $fields,
					'location'   => $location,
					'menu_order' => 1,
				)
			);
		}
	}
}
