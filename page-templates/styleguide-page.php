<?php
/**
 * Template Name: Styleguide
 *
 * Living catalog of the starter design tokens, UI components, and kernel blocks.
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

add_filter(
	'wp_robots',
	static function ( array $robots ): array {
		$robots['noindex']  = true;
		$robots['nofollow'] = true;

		return $robots;
	}
);

$templates = array( 'pages/styleguide-page.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
