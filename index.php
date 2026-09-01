<?php
/**
 * Main template file
 *
 * Fallback router. Renders index.html.twig unless a named page template
 * or 404.php matches first.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

$templates = array( 'index.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
