<?php
/**
 * Category template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\{ Timber };

$templates    = array( 'pages/category.html.twig' );
$data         = Timber::context();

Timber::render( $templates, $data );
