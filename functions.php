<?php
/**
 * WP CINQ functions and definitions
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

// Autoloader.
require_once get_template_directory() . '/vendor/autoload.php';

use Timber\{ Timber };

Timber::init();
// Set Timber template locations
Timber::$locations = array( 'views', 'public' );

// Run the setup.
WPCinquanteEtUn\Init::run_services();
