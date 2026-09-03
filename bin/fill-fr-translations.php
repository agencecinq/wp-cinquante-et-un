<?php
/**
 * Fill French translations in the PO file and compile MO.
 *
 * Usage: php bin/fill-fr-translations.php
 *
 * @package WPCinquanteEtUn
 */

declare(strict_types=1);

$theme_dir = dirname( __DIR__ );
$wp_root   = dirname( __DIR__, 4 );
$po_file   = $theme_dir . '/languages/fr_FR.po';
$mo_file   = $theme_dir . '/languages/fr_FR.mo';
$map_file  = $theme_dir . '/languages/translations/fr_FR.php';

if ( ! is_file( $map_file ) ) {
	fwrite( STDERR, "Missing translation map: languages/translations/fr_FR.php\n" );
	exit( 1 );
}

require_once $wp_root . '/wp-includes/compat.php';
require_once $wp_root . '/wp-includes/pomo/po.php';

/** @var array<string, array{singular: string, plural?: string}> $map */
$map = require $map_file;

$po = new PO();

if ( ! $po->import_from_file( $po_file ) ) {
	fwrite( STDERR, "Could not read PO file.\n" );
	exit( 1 );
}

$filled = 0;

foreach ( $po->entries as $entry ) {
	if ( '' === $entry->singular ) {
		continue;
	}

	$key = $entry->context ? $entry->context . "\4" . $entry->singular : $entry->singular;

	if ( ! isset( $map[ $key ] ) && ! isset( $map[ $entry->singular ] ) ) {
		continue;
	}

	$translation = $map[ $key ] ?? $map[ $entry->singular ];

	$entry->translations = array( $translation['singular'] );

	if ( $entry->is_plural && isset( $translation['plural'] ) ) {
		$entry->translations[1] = $translation['plural'];
	}

	++$filled;
}

$po->set_header( 'Language', 'fr_FR' );
$po->set_header( 'Language-Team', 'French' );
$po->set_header( 'Plural-Forms', 'nplurals=2; plural=(n > 1);' );

if ( ! $po->export_to_file( $po_file ) ) {
	fwrite( STDERR, "Could not write PO file.\n" );
	exit( 1 );
}

require_once $wp_root . '/wp-includes/pomo/mo.php';

$mo = new MO();
$mo->entries = $po->entries;
$mo->headers = $po->headers;

if ( ! $mo->export_to_file( $mo_file ) ) {
	fwrite( STDERR, "Could not write MO file.\n" );
	exit( 1 );
}

echo sprintf( "Filled %d strings in %s and compiled %s\n", $filled, basename( $po_file ), basename( $mo_file ) );
