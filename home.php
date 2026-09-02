<?php
/**
 * Blog posts index
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

$templates = array( 'pages/archive-post.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
