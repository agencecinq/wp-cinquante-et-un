<?php
/**
 * Blocks Fields
 *
 * Registers ACF field group includes for blocks.
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Plugins\ACF\IncludeFields\Layouts\AccordionGroup;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\ChildPages;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\ChildPagesByParent;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Columns;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Contact;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Form;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Gallery;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Grid;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Hero;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\KeyFigures;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\LatestPosts;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Marquee;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\MediaText;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\MultiColumn;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\PageIntroduction;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Presentation;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Process;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Products;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Push;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\StoreLocator;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Styleguide;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Support;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Team;
use Nexiode\Service;

/**
 * Blocks Fields
 *
 * Loads advanced custom fields for blocks.
 */
class BlocksFields implements Service {

	/**
	 * Layout classes used for the blocks field (pages, products). Order = display order.
	 *
	 * @var array<int, class-string>
	 */
	private static $layouts = array(
		AccordionGroup::class,
		ChildPages::class,
		ChildPagesByParent::class,
		Columns::class,
		Contact::class,
		Form::class,
		Gallery::class,
		Grid::class,
		Hero::class,
		KeyFigures::class,
		LatestPosts::class,
		Marquee::class,
		MediaText::class,
		MultiColumn::class,
		PageIntroduction::class,
		Presentation::class,
		Process::class,
		Products::class,
		Push::class,
		StoreLocator::class,
		Styleguide::class,
		Support::class,
		Team::class,
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
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'product',
				),
			),
		);

		$fields = array(
			array(
				'key'          => 'field_' . $key,
				'label'        => __( 'Blocks', 'nexiode' ),
				'name'         => 'blocks',
				'aria-label'   => __( 'Blocks', 'nexiode' ),
				'type'         => 'flexible_content',
				'instructions' => __( 'Add and arrange blocks to build the page content.', 'nexiode' ),
				'layouts'      => AcfFieldHelpers::get_layouts_from( $key, self::$layouts ),
				'button_label' => __( 'Add Block', 'nexiode' ),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'        => 'group_' . $key,
					'title'      => __( 'Blocks Fields', 'nexiode' ),
					'fields'     => $fields,
					'location'   => $location,
					'menu_order' => 1,
				)
			);
		}
	}
}
