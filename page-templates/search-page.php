<?php
/**
 * Template Name: Search Page
 *
 * Landing page for site search. Results are rendered by search.php.
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

$templates = array( 'pages/search.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
