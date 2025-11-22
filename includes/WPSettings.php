<?php
/**
 * WPSettings
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn;

/**
 * WP Settings
 */
class WPSettings {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'after_setup_theme', array( $this, 'register_menus' ) );
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );
	}

	/**
	 * Register nav menus
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_nav_menus/
	 *
	 * @return void
	 */
	public function register_menus(): void {
		register_nav_menus(
			array(
				'main'      => __( 'Main Menu', 'wp-cinquante-et-un' ),
				'secondary' => __( 'Secondary Menu', 'wp-cinquante-et-un' ),
				'footer'    => __( 'Footer Menu', 'wp-cinquante-et-un' ),
				'legals'    => __( 'Legals Menu', 'wp-cinquante-et-un' ),
			)
		);
	}

	/**
	 * Add theme supports
	 *
	 * @return void
	 */
	public function add_theme_supports(): void {
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @see https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
	}
}
