<?php
/**
 * Page template file
 *
 * Default pages render ACF blocks. The named "Blocks" page template is an alias
 * for pages that already have it assigned.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Page
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\{ Timber };

$templates = array( 'pages/blocks-page.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
