<?php
/**
 * Enqueue
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Setup
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Setup;

use WPCinquanteEtUn\{ Service, Vite };

/**
 * Theme asset enqueue setup.
 *
 * Registers and enqueues stylesheets and scripts used by the theme.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn\Setup
 */
class Enqueue implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_styles' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}


	/**
	 * Enqueue styles.
	 *
	 * The starter ships no custom typeface. Add @font-face in font-face.css and/or
	 * register Google Fonts here when the project defines its fonts.
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_styles(): void {
		$filename = Vite::asset( 'src/stylesheets/styles.css' );

		wp_enqueue_style( get_theme_text_domain() . '-main', $filename, array(), null );
		wp_enqueue_style( get_theme_text_domain() . '-style', get_stylesheet_uri(), array( get_theme_text_domain() . '-main' ), null );

		if ( is_page_template( 'page-templates/styleguide-page.php' ) ) {
			wp_enqueue_style(
				get_theme_text_domain() . '-styleguide',
				Vite::asset( 'src/stylesheets/styleguide.css' ),
				array( get_theme_text_domain() . '-main' ),
				null
			);
		}
	}


	/**
	 * Dequeue styles
	 *
	 * Remove styles that are not needed on the front (plugin block library styles, etc.).
	 *
	 * @access public
	 * @return void
	 */
	public function dequeue_styles(): void {
		wp_dequeue_style( 'contact-form-7' );
		wp_deregister_style( 'contact-form-7' );
		wp_dequeue_style( 'contact-form-7-rtl' );
		wp_deregister_style( 'contact-form-7-rtl' );
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_scripts(): void {

		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'wp-embed' );

		$deps = array();

		// Enqueue the Vite module.
		Vite::enqueue_script_module();

		wp_register_script_module(
			get_theme_text_domain() . '-main',
			Vite::asset( 'src/scripts/app.js' ),
			$deps,
			null
		);

		// Empty handle for the global `cinq` object (wp_enqueue_script_module has no inline data API yet).
		wp_register_script( get_theme_text_domain() . '-feature', false );

		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
		$current_url = is_singular() ? get_permalink() : ( $request_uri ? esc_url_raw( home_url( $request_uri ) ) : home_url() );

		$data = array(
			'template_directory_uri' => get_template_directory_uri(),
			'base_url'               => site_url(),
			'home_url'               => home_url( '/' ),
			'ajax_url'               => admin_url( 'admin-ajax.php' ),
			'api_url'                => home_url( 'wp-json' ),
			'current_url'            => $current_url,
			'nonce'                  => wp_create_nonce( 'security' ),
			'text_domain'            => get_theme_text_domain(),
		);

		wp_add_inline_script(
			get_theme_text_domain() . '-feature',
			'var cinq = ' . wp_json_encode(
				$data
			),
			'before'
		);

		wp_enqueue_script( get_theme_text_domain() . '-feature' );
		wp_enqueue_script_module( get_theme_text_domain() . '-main' );

		if ( is_page_template( 'page-templates/styleguide-page.php' ) ) {
			wp_register_script_module(
				get_theme_text_domain() . '-styleguide',
				Vite::asset( 'src/scripts/styleguide.ts' ),
				array(),
				null
			);
			wp_enqueue_script_module( get_theme_text_domain() . '-styleguide' );
		}
	}
}
