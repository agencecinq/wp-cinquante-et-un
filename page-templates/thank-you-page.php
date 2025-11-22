<?php
/**
 * Template Name: Thank You Page
 *
 * This is an example of a custom page template for a Thank You page in a WordPress theme using Timber.
 *
 * @package WPCinquanteEtUn
 */

use Timber\Timber;

$templates = array( 'pages/thank-you-page.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
