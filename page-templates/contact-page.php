<?php
/**
 * Template Name: Contact Page
 *
 * @package WPCinquanteEtUn
 */

use Timber\Timber;

$templates = array( 'pages/contact-page.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
