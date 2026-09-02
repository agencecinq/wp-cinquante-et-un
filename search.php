<?php
/**
 * Search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

$templates = array( 'pages/search.html.twig' );
$context   = Timber::context();

if ( is_search() ) {
	$context['post'] = (object) array(
		'title' => __( 'Search', 'wp-cinquante-et-un' ),
	);
}

Timber::render( $templates, $context );
