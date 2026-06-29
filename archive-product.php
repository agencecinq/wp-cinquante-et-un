<?php
/**
 * Archive product template file
 *
 * @package Nexiode
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\{ Timber };

$templates = array( 'pages/archive-product.html.twig' );
$data      = Timber::context(
	array(
		'post' => get_field( 'archive_products', 'option' ),
	)
);

Timber::render( $templates, $data );
