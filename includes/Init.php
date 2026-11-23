<?php
/**
 * Theme bootstrap: service registration and initialization.
 *
 * Single entry point for instantiating theme classes and calling their run() method.
 * Include early from functions.php so components are loaded before templates.
 *
 * @package WPCinquanteEtUn
 */

namespace WPCinquanteEtUn;

/**
 * Init
 *
 * Registers and runs all theme services. Each service must implement the Service interface.
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */
class Init {

	/**
	 * Theme service classes by domain. Order can matter for dependency or hook priority.
	 *
	 * @return array<int, class-string<Service>>
	 */
	public static function get_services(): array {
		return array(
			// Admin.
			Admin\Init::class,
			Admin\Menu::class,
			Admin\Notices::class,
			// Setup.
			Setup\Enqueue::class,
			Setup\Context::class,
			Setup\Twig::class,
			// WordPress integration.
			WPSettings::class,
			Post\Post::class,
			GeneralTemplate::class,
			// Template.
			Template\PostStates::class,
			// Build & assets.
			Vite::class,
			// ACF.
			Plugins\ACF\Init::class,
			Plugins\ACF\Input\AdminEnqueueScripts::class,
			Plugins\ACF\FormatValue::class,
			Plugins\ACF\IncludeFields\BlocksFields::class,
			Plugins\ACF\IncludeFields\PostFields::class,
			Plugins\ACF\IncludeFields\PageFields::class,
			Plugins\ACF\IncludeFields\ThemeFields::class,
			Plugins\ACF\IncludeFields\ArchivePostsFields::class,
			Plugins\ACF\IncludeFields\AttachmentFields::class,
		);
	}

	/**
	 * Instantiate each service and call run() when it implements Service.
	 *
	 * @return void
	 */
	public static function run_services(): void {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( $service instanceof Service ) {
				$service->run();
			}
		}
	}

	/**
	 * Create an instance of the given class.
	 *
	 * @param class-string $class_name Fully qualified class name.
	 * @return object Instance of the class.
	 */
	private static function instantiate( string $class_name ): object {
		return new $class_name();
	}
}
