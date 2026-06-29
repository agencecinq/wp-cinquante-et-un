<?php
/**
 * Product Category template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Nexiode
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\{ Timber };

$templates = array( 'pages/archive-product.html.twig' );
$data      = Timber::context(
	array(
		'post' => get_field( 'taxonomy_product_cat', 'term_' . get_queried_object()->term_id ),
	)
);

Timber::render( $templates, $data );
