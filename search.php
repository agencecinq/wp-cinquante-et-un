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
$data      = Timber::context();

Timber::render( $templates, $data );
