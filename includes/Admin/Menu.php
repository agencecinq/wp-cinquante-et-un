<?php
/**
 * Class Menu
 *
 * @package Nexiode
 * @subpackage Nexiode/Menu
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace Nexiode\Admin;

use Nexiode\Service;

/**
 * Menu
 *
 * Adds custom menu pages to the admin area.
 *
 * @package WordPress
 * @subpackage Nexiode/Admin
 */
class Menu implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_menu/
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'admin_menu', array( $this, 'add_options_page' ), 10, 1 );
	}
	/**
	 * Adds admin menu pages.
	 *
	 * @param string $context The context in which the menu is loaded.
	 * @return void
	 */
	public function add_options_page( string $context = '' ) {
		add_options_page(
			__( 'Socials', 'nexiode' ),
			__( 'Socials', 'nexiode' ),
			'manage_options',
			'socials',
			array( $this, 'add_socials_option_page' )
		);
	}


	/**
	 * Options page callback
	 */
	public function add_socials_option_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Socials', 'nexiode' ); ?></h1>
			<form method="post" action="options.php">
			<?php
				settings_fields( 'socials' );
				do_settings_sections( 'socials' );
				submit_button( __( 'Save Changes', 'nexiode' ) );
			?>
			</form>
		</div>
		<?php
	}
}
