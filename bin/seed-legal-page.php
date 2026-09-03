<?php
/**
 * Seed the legal mentions content page.
 *
 * Usage (Local site running):
 * wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-legal-page.php \
 *   --path=/path/to/wordpress/public
 *
 * @package WPCinquanteEtUn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'update_field' ) ) {
	WP_CLI::error( 'Advanced Custom Fields must be active.' );
}

require_once __DIR__ . '/seed-helpers.php';

$page_id = cinq_seed_mentions_legales_page();

if ( ! $page_id ) {
	WP_CLI::error( 'Could not create the legal mentions page.' );
}

cinq_seed_footer_menus( $page_id );

WP_CLI::success(
	sprintf(
		'Legal mentions page seeded (ID %d). URL: %s',
		$page_id,
		get_permalink( $page_id )
	)
);
