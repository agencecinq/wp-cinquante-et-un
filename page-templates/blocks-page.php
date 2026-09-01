<?php
/**
 * Template Name: Blocks
 *
 * Alias of the default page router. Kept so existing pages assigned this
 * template keep working. New pages use page.php (same Twig).
 *
 * @package WPCinquanteEtUn
 */

use Timber\Timber;

$templates = array( 'pages/blocks-page.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
