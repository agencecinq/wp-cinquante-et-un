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
	 * Fonts painted above the fold (body, headings), as file names in src/fonts/
	 * without extension. Preloaded so they are not discovered only once the CSS is parsed.
	 *
	 * @var string[]
	 */
	private const PRELOAD_FONTS = array();

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_styles' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'wp_preload_resources', array( $this, 'preload_resources' ) );
		add_filter( 'wp_speculation_rules_configuration', array( $this, 'speculation_rules_configuration' ) );

		// Contact Form 7 scripts only on pages that render a form.
		add_filter( 'wpcf7_load_js', '__return_false' );
		add_action( 'wpcf7_shortcode_callback', 'wpcf7_enqueue_scripts' );
	}


	/**
	 * Preload resources
	 *
	 * @param array $resources Resources to preload.
	 * @return array
	 */
	public function preload_resources( array $resources ): array {
		foreach ( self::PRELOAD_FONTS as $font ) {
			$resources[] = array(
				'href'        => Vite::asset( 'src/fonts/' . $font . '.woff2' ),
				'as'          => 'font',
				'type'        => 'font/woff2',
				'crossorigin' => 'anonymous',
			);
		}

		return $resources;
	}


	/**
	 * Prefetch a linked page after a short hover (`moderate`) rather than on
	 * click. Prefetch only: prerendering would play the scroll animations
	 * before the page is shown. `null` (logged-in visitors, plain permalinks)
	 * keeps speculative loading off.
	 *
	 * @param array|null $config Speculation rules configuration.
	 * @return array|null
	 */
	public function speculation_rules_configuration( ?array $config ): ?array {
		if ( null === $config ) {
			return null;
		}

		return array(
			'mode'      => 'prefetch',
			'eagerness' => 'moderate',
		);
	}


	/**
	 * Enqueue styles.
	 *
	 * Fonts are self-hosted: files in src/fonts/, @font-face in font-face.css,
	 * above-the-fold files listed in PRELOAD_FONTS.
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_styles(): void {
		$filename = Vite::asset( 'src/stylesheets/styles.css' );

		// Color variables from includes/schemes.php, inline only (no file).
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Inline only.
		wp_register_style( get_theme_text_domain() . '-colors', false, array(), null );
		wp_add_inline_style( get_theme_text_domain() . '-colors', cinq_colors_css() );
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Vite hashes the filename.
		wp_enqueue_style( get_theme_text_domain() . '-main', $filename, array( get_theme_text_domain() . '-colors' ), null );

		if ( is_page_template( 'page-templates/styleguide-page.php' ) ) {
			wp_enqueue_style(
				get_theme_text_domain() . '-styleguide',
				Vite::asset( 'src/stylesheets/styleguide.css' ),
				array( get_theme_text_domain() . '-main' ),
				null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Vite hashes the filename.
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

		// Enqueue the Vite module.
		Vite::enqueue_script_module();

		/*
		 * Data a component needs from PHP goes through the core
		 * `script_module_data_{$module_id}` filter, read in TS from the
		 * `wp-script-module-data-{$module_id}` JSON script. No global object.
		 */
		wp_register_script_module(
			get_theme_text_domain() . '-main',
			Vite::asset( 'src/scripts/app.js' ),
			array(),
			null
		);

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
