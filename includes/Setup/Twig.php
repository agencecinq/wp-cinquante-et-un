<?php
/**
 * Twig
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Setup
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Setup;

use Twig\Extra\Html\{ HtmlExtension };
use Twig\Extra\Intl\{ IntlExtension };
use Twig\{ TwigFilter, TwigFunction };
use WPCinquanteEtUn\{ Service, Vite };

/**
 * Twig
 */
class Twig implements Service {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'timber/twig', array( $this, 'add_functions' ) );
		add_filter( 'timber/twig', array( $this, 'add_filters' ) );
		add_filter( 'timber/twig', array( $this, 'add_extensions' ) );
		add_filter( 'timber/twig/environment/options', array( $this, 'set_environment_options' ), 10, 1 );
	}



	/**
	 * Set options
	 *
	 * @param array $options Array of options.
	 *
	 * @return array $options
	 */
	public function set_environment_options( array $options ): array {
		$options['cache']       = WP_DEBUG ? false : true;
		$options['auto_reload'] = WP_DEBUG;

		return $options;
	}


	/**
	 * Add extensions
	 *
	 * @param object $twig Twig environment.
	 *
	 * @access public
	 *
	 * @return object $twig
	 */
	public function add_extensions( object $twig ): object {
		$twig->addExtension( new HtmlExtension() );
		$twig->addExtension( new IntlExtension() );

		return $twig;
	}


	/**
	 * Add filters
	 *
	 * The antispambot filter encodes an email address as a mix of HTML
	 * entities and plain characters, so harvesters that match addresses in
	 * the raw HTML miss it while browsers and screen readers read it as
	 * usual. esc_attr() keeps those entities as they are, unlike Twig's
	 * escaper, and makes the result safe in an attribute and in text.
	 *
	 * The mailto_href filter prints the whole href attribute of a mailto:
	 * URL, its address encoded the same way, and nothing for any other URL:
	 * html_attr() would escape the entities a second time.
	 *
	 * @param object $twig Twig environment.
	 *
	 * @access public
	 *
	 * @return object $twig
	 *
	 * @see https://developer.wordpress.org/reference/functions/antispambot/
	 */
	public function add_filters( object $twig ): object {
		$twig->addFilter(
			new TwigFilter(
				'antispambot',
				function ( ?string $email ): string {
					return esc_attr( antispambot( (string) $email ) );
				},
				array( 'is_safe' => array( 'html' ) )
			)
		);

		$twig->addFilter(
			new TwigFilter(
				'mailto_href',
				function ( ?string $url ): string {
					if ( ! str_starts_with( (string) $url, 'mailto:' ) ) {
						return '';
					}

					$email = substr( $url, strlen( 'mailto:' ) );

					return 'href="mailto:' . esc_attr( antispambot( $email ) ) . '"';
				},
				array( 'is_safe' => array( 'html' ) )
			)
		);

		return $twig;
	}


	/**
	 * Add functions
	 *
	 * @param object $twig Twig environment.
	 *
	 * @access public
	 *
	 * @return object $twig
	 */
	public function add_functions( object $twig ): object {
		$twig->addFunction(
			new TwigFunction(
				'html_class',
				function ( string $args = '' ) {
					return html_class( $args );
				}
			)
		);

		$twig->addFunction(
			new TwigFunction(
				'body_class',
				function ( $args = '' ) {
					return body_class( $args );
				}
			)
		);

		// Add get_extended function.
		if ( function_exists( 'get_extended' ) ) {
			$twig->addFunction(
				new TwigFunction(
					'get_extended',
					function ( $content ) {
						return get_extended( $content );
					}
				)
			);
		}

		$twig->addFunction( new TwigFunction( 'uniqid', 'uniqid' ) );

		$twig->addFunction(
			new TwigFunction(
				'asset',
				function ( $asset ) {
					return Vite::asset( $asset );
				}
			)
		);

		// @see https://developer.wordpress.org/reference/functions/get_search_form/
		$twig->addFunction(
			new TwigFunction(
				'get_search_form',
				function ( $args = array( 'echo' => false ) ) {
					return get_search_form( $args );
				}
			)
		);

		// @see https://developer.wordpress.org/reference/functions/get_search_query/
		$twig->addFunction(
			new TwigFunction(
				'get_search_query',
				function () {
					return get_search_query();
				}
			)
		);

		$twig->addFunction(
			new TwigFunction(
				'yoast_breadcrumb',
				function ( $before = '', $after = '', $display = false ) {
					if ( ! function_exists( 'yoast_breadcrumb' ) ) {
						return '';
					}

					$html = yoast_breadcrumb( $before, $after, $display );

					return is_string( $html ) ? $html : '';
				}
			)
		);

		$twig->addFunction( new TwigFunction( 'cinq_schemes', 'cinq_schemes' ) );
		$twig->addFunction( new TwigFunction( 'cinq_palette', 'cinq_palette' ) );
		$twig->addFunction( new TwigFunction( 'cinq_scheme_roles', 'cinq_scheme_roles' ) );

		return $twig;
	}
}
