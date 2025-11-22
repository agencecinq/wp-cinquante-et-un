<?php
/**
 * Bootstrap and load manager for the wp-cinquante-et-un theme's include files.
 *
 * Centralizes the initialization process for the theme by locating,
 * validating and requiring files from the theme's includes directory.
 * This file acts as the single entry point for registering theme
 * functionality, instantiating core classes, and attaching actions
 * and filters required for the theme to operate correctly.
 *
 * Responsibilities:
 *  - Define and resolve include paths for the theme
 *  - Require or autoload core include files (setup, hooks, helpers, etc.)
 *  - Instantiate and register theme services or classes
 *  - Register theme support features, actions, and filters
 *  - Provide a clear load order and error handling for missing includes
 *
 * Usage:
 *  Include this file early (typically from functions.php) so that
 *  theme components are loaded before templates and front-end requests.
 *
 * @file
 * @package WPCinquanteEtUn
 */

namespace WPCinquanteEtUn;

/**
 * Init
 *
 * Initializes all the classes in the theme.
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */
class Init {

	/**
	 * Store all the classes inside an array
	 *
	 *
	 *
	 * @return array Full list of classes
	 */
	public static function get_services(): array {
		return array(
			Admin\Init::class,
			Admin\Menu::class,
			Setup\Enqueue::class,
			Setup\Context::class,
			WPImageEditor::class,
			WPSettings::class,
			GeneralTemplate::class,
			Setup\Twig::class,
			PostTemplate\BodyClass::class,
			PostTemplate\PostClass::class,
			Template\Loader::class,
			Template\PostStates::class,
			Vite::class,
			Plugins\Polylang\RegisterStrings::class,
			Plugins\ACF\SavePost::class,
		);
	}


	/**
	 * Loop through the classes, initialize them, and call the run() method if it exists
	 *
	 * @return void
	 */
	public static function run_services(): void {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );

			if ( method_exists( $service, 'run' ) ) {
				$service->run();
			}
		}
	}


	/**
	 * Initialize the class
	 *
	 * @param  string $class class name from the services array.
	 * @return object
	 */
	private static function instantiate( string $class ): object {
		return new $class();
	}
}
