<?php
/**
 * Main template file
 *
 * Fallback router. Pages use index.html.twig (ACF blocks). Named page
 * templates and 404.php still win in the WordPress hierarchy. Blog and
 * single post views use home.php, category.php, tag.php and single.php.
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
