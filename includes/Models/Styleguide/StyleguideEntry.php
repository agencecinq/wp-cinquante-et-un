<?php
/**
 * Styleguide catalog entry helpers.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide;

/**
 * Builds normalized styleguide block catalog entries.
 */
class StyleguideEntry {

	/**
	 * Single-layout catalog entry (one render, no variant switcher).
	 *
	 * @param string               $id    Anchor id.
	 * @param string               $name  Catalog label.
	 * @param string               $file  Production Twig path.
	 * @param array<string, mixed> $block Block context passed to the Twig.
	 * @return array<string, mixed>
	 */
	public static function single( string $id, string $name, string $file, array $block ): array {
		return array(
			'id'    => $id,
			'name'  => $name,
			'file'  => $file,
			'block' => $block,
		);
	}

	/**
	 * Playground entry with client-side variant switching.
	 *
	 * @param string                           $id       Anchor id.
	 * @param string                           $name     Catalog label.
	 * @param string                           $file     Production Twig path.
	 * @param array<int, array<string, mixed>> $variants Variant rows from variant().
	 * @return array<string, mixed>
	 */
	public static function playground( string $id, string $name, string $file, array $variants ): array {
		return array(
			'id'       => $id,
			'name'     => $name,
			'file'     => $file,
			'variants' => $variants,
		);
	}

	/**
	 * One playground variant.
	 *
	 * @param string               $id    Variant slug (unique within the playground).
	 * @param string               $label Select label.
	 * @param array<string, mixed> $block Block context passed to the Twig.
	 * @return array<string, mixed>
	 */
	public static function variant( string $id, string $label, array $block ): array {
		return array(
			'id'    => $id,
			'label' => $label,
			'block' => $block,
		);
	}

	/**
	 * Runs cinq_enrich_block() on single entries and playground variants.
	 *
	 * @param array<int, array<string, mixed>> $entries Catalog rows.
	 * @return void
	 */
	public static function enrich_blocks( array &$entries ): void {
		foreach ( $entries as &$entry ) {
			if ( isset( $entry['variants'] ) && is_array( $entry['variants'] ) ) {
				foreach ( $entry['variants'] as &$variant ) {
					if ( isset( $variant['block'] ) && is_array( $variant['block'] ) ) {
						cinq_enrich_block( $variant['block'] );
					}
				}
				unset( $variant );
				continue;
			}

			if ( isset( $entry['block'] ) && is_array( $entry['block'] ) ) {
				cinq_enrich_block( $entry['block'] );
			}
		}
		unset( $entry );
	}
}
