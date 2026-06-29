<?php
/**
 * Template Name: Blocks
 *
 * @package Nexiode
 */

use Timber\Timber;

$templates = array( 'pages/blocks-page.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
