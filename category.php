<?php
/**
 * Category archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

$templates    = array( 'pages/archive-post.html.twig' );
$data         = Timber::context();
$data['post'] = $data['term'];

Timber::render( $templates, $data );
