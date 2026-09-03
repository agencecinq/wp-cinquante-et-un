<?php
/**
 * Export POT/PO entries as JSON (for translation tooling).
 *
 * Usage: wp eval-file bin/export-msgids.php
 *
 * @package WPCinquanteEtUn
 */

require_once ABSPATH . 'wp-includes/pomo/po.php';

$theme_dir = dirname( __DIR__ );
$pot_file  = $theme_dir . '/languages/wp-cinquante-et-un.pot';
$po        = new PO();

if ( ! $po->import_from_file( $pot_file ) ) {
	fwrite( STDERR, "Could not read POT file.\n" );
	exit( 1 );
}

$entries = array();

foreach ( $po->entries as $key => $entry ) {
	if ( '' === $entry->singular ) {
		continue;
	}

	$entries[] = array(
		'key'     => $key,
		'singular' => $entry->singular,
		'plural'  => $entry->plural ?? '',
		'context' => $entry->context ?? '',
	);
}

usort(
	$entries,
	static function ( array $a, array $b ): int {
		return strcmp( $a['singular'], $b['singular'] );
	}
);

file_put_contents(
	$theme_dir . '/languages/.msgids.json',
	wp_json_encode( $entries, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) . "\n"
);

echo count( $entries ), " entries exported to languages/.msgids.json\n";
