<?php
/**
 * ACF Init
 *
 * @package Nexiode
 * @subpackage Nexiode/Plugins/ACF
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace Nexiode\Plugins\ACF;

use Nexiode\Plugins\ACF\FieldTypes\MenuItemSelect;
use Nexiode\Service;

/**
 * ACF Init
 *
 * @package Nexiode
 * @subpackage Nexiode/Plugins/ACF
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */
class Init implements Service {

	/**
	 * Runs the initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'acf/init', array( $this, 'add_options_pages' ) );
		add_action( 'acf/init', array( $this, 'register_menu_item_select_field' ) );
	}


	/**
	 * Adds the options pages.
	 *
	 * @return void
	 */
	public function add_options_pages(): void {
		acf_add_options_page(
			array(
				'page_title'  => __( 'Archive', 'nexiode' ),
				'menu_slug'   => 'archive-product',
				'parent_slug' => 'edit.php?post_type=product',
				'position'    => '',
				'redirect'    => false,
			)
		);

		acf_add_options_page(
			array(
				'page_title'  => __( 'Archive', 'nexiode' ),
				'menu_slug'   => 'archive-post',
				'parent_slug' => 'edit.php',
				'position'    => '',
				'redirect'    => false,
			)
		);

		acf_add_options_page(
			array(
				'page_title'  => __( 'Theme', 'nexiode' ),
				'menu_slug'   => 'options-theme',
				'parent_slug' => 'options-general.php',
				'position'    => '',
				'redirect'    => false,
			)
		);
	}

	/**
	 * Registers the custom ACF field type "Menu Item Select".
	 *
	 * @return void
	 */
	public function register_menu_item_select_field(): void {
		if ( function_exists( 'acf_register_field_type' ) ) {
			acf_register_field_type( MenuItemSelect::class );
		}
	}
}
