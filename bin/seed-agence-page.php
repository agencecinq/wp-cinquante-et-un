<?php
/**
 * Seed the agency page demo content.
 *
 * Usage (Local site running):
 * wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-agence-page.php \
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

WP_CLI::log( 'Importing placeholder images…' );

$hero_image_id   = cinq_seed_import_remote_image( 'https://placehold.co/1600x900/jpg', 'Agency hero placeholder' );
$media_image_id  = cinq_seed_import_remote_image( 'https://placehold.co/1200x900/jpg', 'Agency media placeholder' );
$avatar_image_id = cinq_seed_import_remote_image( 'https://placehold.co/80x80/jpg', 'Agency avatar placeholder' );

WP_CLI::log( 'Seeding agency page…' );

$page_id = cinq_seed_agence_page( $hero_image_id, $media_image_id, $avatar_image_id );

if ( ! $page_id ) {
	WP_CLI::error( 'Could not create the agency page.' );
}

WP_CLI::log( 'Updating navigation menus…' );
cinq_seed_main_menu();
cinq_seed_footer_menus( cinq_seed_mentions_legales_page() );

WP_CLI::success(
	sprintf(
		'Agency page seeded (ID %d). URL: %s',
		$page_id,
		get_permalink( $page_id )
	)
);
