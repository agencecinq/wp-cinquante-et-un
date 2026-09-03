<?php
/**
 * Regenerate the theme POT file (PHP via WP-CLI + Twig scan).
 * Syncs fr_FR.po/.mo when the PO file exists.
 *
 * Usage: php bin/make-pot.php
 *
 * @package WPCinquanteEtUn
 */

declare(strict_types=1);

$theme_dir = dirname( __DIR__ );
$pot_file  = $theme_dir . '/languages/wp-cinquante-et-un.pot';
$domain    = 'wp-cinquante-et-un';
$twig_pot  = sys_get_temp_dir() . '/wp-cinquante-et-un-twig.pot';

$exclude = 'node_modules,vendor,dist,bin,acf-json,.cursor,public';
$command = sprintf(
	'wp i18n make-pot %s %s --domain=%s --exclude=%s 2>/dev/null',
	escapeshellarg( $theme_dir ),
	escapeshellarg( $pot_file ),
	escapeshellarg( $domain ),
	escapeshellarg( $exclude )
);

exec( $command, $output, $exit_code );

if ( 0 !== $exit_code || ! is_file( $pot_file ) ) {
	fwrite( STDERR, "wp i18n make-pot failed.\n" );
	exit( 1 );
}

$twig_entries = extract_twig_entries( $theme_dir . '/views', $domain );

if ( array() === $twig_entries ) {
	exit( 0 );
}

write_twig_pot( $twig_pot, $twig_entries, $domain );

$merged_pot = sys_get_temp_dir() . '/wp-cinquante-et-un-merged.pot';
$merge_cmd  = sprintf(
	'msgcat --use-first --no-wrap --sort-output -o %s %s %s 2>/dev/null',
	escapeshellarg( $merged_pot ),
	escapeshellarg( $pot_file ),
	escapeshellarg( $twig_pot )
);

exec( $merge_cmd, $merge_output, $merge_exit );

if ( 0 !== $merge_exit || ! is_file( $merged_pot ) ) {
	fwrite( STDERR, "msgcat merge failed.\n" );
	exit( 1 );
}

copy( $merged_pot, $pot_file );
unlink( $twig_pot );
unlink( $merged_pot );

$fr_po = $theme_dir . '/languages/fr_FR.po';

if ( is_file( $fr_po ) ) {
	$merge_po_cmd = sprintf(
		'msgmerge --update --no-fuzzy-matching %s %s 2>/dev/null',
		escapeshellarg( $fr_po ),
		escapeshellarg( $pot_file )
	);
	exec( $merge_po_cmd, $merge_po_output, $merge_po_exit );

	if ( 0 === $merge_po_exit ) {
		exec( 'php ' . escapeshellarg( $theme_dir . '/bin/fill-fr-translations.php' ), $fill_output, $fill_exit );
	}
}

/**
 * @param string $views_dir Views directory.
 * @param string $domain    Text domain.
 * @return array<int, array<string, mixed>>
 */
function extract_twig_entries( string $views_dir, string $domain ): array {
	$entries = array();
	$files   = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $views_dir, FilesystemIterator::SKIP_DOTS )
	);

	foreach ( $files as $file ) {
		if ( ! $file instanceof SplFileInfo || 'twig' !== $file->getExtension() ) {
			continue;
		}

		$path    = $file->getPathname();
		$content = file_get_contents( $path );

		if ( false === $content ) {
			continue;
		}

		$relative = 'views/' . substr( $path, strlen( $views_dir ) + 1 );

		extract_function_calls( $content, $relative, $domain, $entries );
	}

	return $entries;
}

/**
 * @param string               $content  File contents.
 * @param string               $relative Relative file path.
 * @param string               $domain   Text domain.
 * @param array<int, array<string, mixed>> $entries  Collected entries.
 * @return void
 */
function extract_function_calls( string $content, string $relative, string $domain, array &$entries ): void {
	$patterns = array(
		'/(?:__|_e|esc_html__|esc_attr__)\s*\(\s*((?:\'(?:\\\\.|[^\'])*\'|"(?:\\\\.|[^"])*"))\s*,\s*[\'"]([^\'"]+)[\'"]\s*\)/',
		'/_x\s*\(\s*((?:\'(?:\\\\.|[^\'])*\'|"(?:\\\\.|[^"])*"))\s*,\s*((?:\'(?:\\\\.|[^\'])*\'|"(?:\\\\.|[^"])*"))\s*,\s*[\'"]([^\'"]+)[\'"]\s*\)/',
		'/_n\s*\(\s*((?:\'(?:\\\\.|[^\'])*\'|"(?:\\\\.|[^"])*"))\s*,\s*((?:\'(?:\\\\.|[^\'])*\'|"(?:\\\\.|[^"])*"))\s*,\s*[^,]+,\s*[\'"]([^\'"]+)[\'"]\s*\)/',
	);

	foreach ( $patterns as $index => $pattern ) {
		if ( ! preg_match_all( $pattern, $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			continue;
		}

		foreach ( $matches[0] as $match_index => $match ) {
			$offset = $match[1];
			$line   = 1 + substr_count( substr( $content, 0, $offset ), "\n" );

			if ( 2 === $index ) {
				$entry_domain = unquote_pot_string( $matches[3][ $match_index ][0] );

				if ( $domain !== $entry_domain ) {
					continue;
				}

				add_entry(
					$entries,
					unquote_pot_string( $matches[1][ $match_index ][0] ),
					$relative,
					$line,
					unquote_pot_string( $matches[2][ $match_index ][0] )
				);
				continue;
			}

			if ( 1 === $index ) {
				$entry_domain = unquote_pot_string( $matches[3][ $match_index ][0] );

				if ( $domain !== $entry_domain ) {
					continue;
				}

				add_entry(
					$entries,
					unquote_pot_string( $matches[1][ $match_index ][0] ),
					$relative,
					$line,
					null,
					unquote_pot_string( $matches[2][ $match_index ][0] )
				);
				continue;
			}

			$entry_domain = unquote_pot_string( $matches[2][ $match_index ][0] );

			if ( $domain !== $entry_domain ) {
				continue;
			}

			add_entry(
				$entries,
				unquote_pot_string( $matches[1][ $match_index ][0] ),
				$relative,
				$line
			);
		}
	}
}

/**
 * @param array<int, array<string, mixed>> $entries Entries list.
 * @param string                           $msgid   Message ID.
 * @param string                           $file    Source file.
 * @param int                              $line    Source line.
 * @param string|null                      $plural  Plural form.
 * @param string|null                      $context Message context.
 * @return void
 */
function add_entry( array &$entries, string $msgid, string $file, int $line, ?string $plural = null, ?string $context = null ): void {
	if ( '' === $msgid ) {
		return;
	}

	$key = ( $context ?? '' ) . "\0" . $msgid . "\0" . ( $plural ?? '' );

	if ( ! isset( $entries[ $key ] ) ) {
		$entries[ $key ] = array(
			'msgid'    => $msgid,
			'plural'   => $plural,
			'context'  => $context,
			'references' => array(),
		);
	}

	$entries[ $key ]['references'][] = sprintf( '%s:%d', $file, $line );
}

/**
 * @param string $literal Quoted PHP/Twig string literal.
 * @return string
 */
function unquote_pot_string( string $literal ): string {
	$literal = trim( $literal );

	if ( str_starts_with( $literal, "'" ) ) {
		return stripcslashes( substr( $literal, 1, -1 ) );
	}

	if ( str_starts_with( $literal, '"' ) ) {
		return stripcslashes( substr( $literal, 1, -1 ) );
	}

	return $literal;
}

/**
 * @param string                           $pot_file Output path.
 * @param array<int, array<string, mixed>> $entries  Twig entries.
 * @param string                           $domain   Text domain.
 * @return void
 */
function write_twig_pot( string $pot_file, array $entries, string $domain ): void {
	$lines   = array();
	$lines[] = 'msgid ""';
	$lines[] = 'msgstr ""';
	$lines[] = '"Content-Type: text/plain; charset=UTF-8\\n"';
	$lines[] = sprintf( '"X-Domain: %s\\n"', $domain );
	$lines[] = '';

	uasort(
		$entries,
		static function ( array $a, array $b ): int {
			return strcmp( $a['msgid'], $b['msgid'] );
		}
	);

	foreach ( $entries as $entry ) {
		sort( $entry['references'] );

		foreach ( array_unique( $entry['references'] ) as $reference ) {
			$lines[] = '#: ' . $reference;
		}

		if ( ! empty( $entry['context'] ) ) {
			$lines[] = 'msgctxt "' . pot_escape( $entry['context'] ) . '"';
		}

		$lines[] = 'msgid "' . pot_escape( $entry['msgid'] ) . '"';

		if ( ! empty( $entry['plural'] ) ) {
			$lines[] = 'msgid_plural "' . pot_escape( $entry['plural'] ) . '"';
			$lines[] = 'msgstr[0] ""';
			$lines[] = 'msgstr[1] ""';
		} else {
			$lines[] = 'msgstr ""';
		}

		$lines[] = '';
	}

	file_put_contents( $pot_file, implode( "\n", $lines ) . "\n" );
}

/**
 * @param string $string Raw string.
 * @return string
 */
function pot_escape( string $string ): string {
	return addcslashes( $string, "\0..\37\"\\" );
}
