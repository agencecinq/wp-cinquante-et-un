<?php
/**
 * Archive Products Fields
 *
 * Registers ACF field group for the products archive (options: theme and archive-product).
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Plugins\ACF\IncludeFields\Layouts\AccordionGroup;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\ChildPages;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\ChildPagesByParent;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Gallery;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Grid;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Hero;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\KeyFigures;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\LatestPosts;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Marquee;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\MediaText;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\MultiColumn;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Presentation;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Process;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Products;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Push;
use Nexiode\Plugins\ACF\IncludeFields\Layouts\Styleguide;
use Nexiode\Service;

/**
 * Archive Products Fields
 *
 * Loads advanced custom fields for the products archive options.
 */
class ArchiveProductsFields implements Service {

	/**
	 * Layout classes for the archive products blocks. Order = display order.
	 * Adjust this list to enable only the layouts you want for this context.
	 *
	 * @var array<int, class-string>
	 */
	private static $layouts = array(
		AccordionGroup::class,
		ChildPages::class,
		ChildPagesByParent::class,
		Hero::class,
		Gallery::class,
		Grid::class,
		Presentation::class,
		Process::class,
		Products::class,
		KeyFigures::class,
		LatestPosts::class,
		Marquee::class,
		MediaText::class,
		MultiColumn::class,
		Push::class,
		Styleguide::class,
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
	public function fields(): void {
		$key = 'archive_products';

		$location = array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'archive-product',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key,
				'label'      => __( 'Archive Products', 'nexiode' ),
				'name'       => 'archive_products',
				'aria-label' => __( 'Archive Products', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'        => 'field_' . $key . '_hero',
						'label'      => __( 'Hero', 'nexiode' ),
						'name'       => 'hero',
						'aria-label' => __( 'Hero', 'nexiode' ),
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_hero_title',
								'label'        => __( 'Title', 'nexiode' ),
								'name'         => 'title',
								'aria-label'   => __( 'Title', 'nexiode' ),
								'type'         => 'text',
								'placeholder'  => __( 'Enter the title of the hero', 'nexiode' ),
								'instructions' => __( 'Main heading for the products archive hero.', 'nexiode' ),
							),
							array(
								'key'          => 'field_' . $key . '_hero_text',
								'label'        => __( 'Text', 'nexiode' ),
								'name'         => 'text',
								'aria-label'   => __( 'Text', 'nexiode' ),
								'type'         => 'textarea',
								'placeholder'  => __( 'Enter the text of the hero', 'nexiode' ),
								'rows'         => 4,
								'new_lines'    => 'br',
								'instructions' => __( 'Short description below the title.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
							),
							array(
								'key'           => 'field_' . $key . '_hero_image',
								'label'         => __( 'Image', 'nexiode' ),
								'name'          => 'image',
								'aria-label'    => __( 'Image', 'nexiode' ),
								'type'          => 'image',
								'return_format' => 'id',
								'instructions'  => __( 'Select or upload a background or hero image.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
							),
						),
					),
					array(
						'key'          => 'field_' . $key . '_blocks',
						'label'        => __( 'Blocks', 'nexiode' ),
						'name'         => 'blocks',
						'aria-label'   => __( 'Blocks', 'nexiode' ),
						'type'         => 'flexible_content',
						'instructions' => __( 'Add and arrange blocks to build the page content.', 'nexiode' ),
						'layouts'      => AcfFieldHelpers::get_layouts_from( $key, self::$layouts ),
						'button_label' => __( 'Add Block', 'nexiode' ),
					),
				),
			),

		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'      => 'group_' . $key,
					'title'    => __( 'Archive Products', 'nexiode' ),
					'fields'   => $fields,
					'location' => $location,
				)
			);
		}
	}
}
