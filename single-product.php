<?php
/**
 * Single product template file
 *
 * This template is used to display a single product.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nexiode
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\{ Timber };

$templates = array( 'pages/single-product.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
