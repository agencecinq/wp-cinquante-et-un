<?php
/**
 * SavePost Class
 *
 * @package Nexiode
 * @subpackage Nexiode/Plugins/ACF
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace Nexiode\Plugins\ACF;

use Nexiode\Service;

/**
 * SavePost Class
 */
class SavePost implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_filter( 'acf/save_post', array( $this, 'save_post' ), 20, 1 );
	}

	/**
	 * Handles the saving of a post using its ID.
	 *
	 * Fills store locator coordinates from address via geocoding when possible.
	 *
	 * @param int|string $post_id The ID of the post being saved.
	 */
	public function save_post( int|string $post_id ): void {
		if ( ! is_numeric( $post_id ) || (int) $post_id <= 0 ) {
			return;
		}

		$blocks = get_field( 'blocks', (int) $post_id );
		if ( ! is_array( $blocks ) ) {
			return;
		}

		$updated = false;
		foreach ( $blocks as $index => $block ) {
			if ( ( $block['acf_fc_layout'] ?? '' ) !== 'store_locator' ) {
				continue;
			}

			$items = $block['stores']['items'] ?? [];
			if ( ! is_array( $items ) ) {
				continue;
			}

			foreach ( $items as $item_index => $item ) {
				$address = trim( (string) ( $item['address'] ?? '' ) );
				if ( $address === '' ) {
					continue;
				}

				$coords = $item['coordinates'] ?? array();
				$lat    = trim( (string) ( $coords['latitude'] ?? '' ) );
				$lng    = trim( (string) ( $coords['longitude'] ?? '' ) );

				if ( $lat !== '' && $lng !== '' ) {
					continue;
				}

				if ( $updated ) {
					sleep( 1 );
				}
				$geocoded = $this->geocode_address( $address );
				if ( $geocoded === null ) {
					continue;
				}

				$blocks[ $index ]['stores']['items'][ $item_index ]['coordinates']['latitude']  = $geocoded['lat'];
				$blocks[ $index ]['stores']['items'][ $item_index ]['coordinates']['longitude'] = $geocoded['lon'];
				$updated = true;
			}
		}

		if ( $updated ) {
			update_field( 'blocks', $blocks, (int) $post_id );
		}
	}

	/**
	 * Geocode an address using Nominatim (OpenStreetMap).
	 *
	 * @param string $address Full address string.
	 * @return array{lat: string, lon: string}|null Lat/lon or null on failure.
	 */
	private function geocode_address( string $address ): ?array {
		$url = add_query_arg(
			array(
				'q'      => $address,
				'format' => 'json',
				'limit'  => 1,
			),
			'https://nominatim.openstreetmap.org/search'
		);

		$response = wp_remote_get(
			$url,
			array(
				'timeout'    => 5,
				'user-agent' => 'Nexiode-Theme/1.0 (WordPress; ' . get_bloginfo( 'url' ) . ')',
				'headers'    => array(
					'Accept-Language' => get_locale(),
				),
			)
		);

		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
			return null;
		}

		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );
		if ( ! is_array( $data ) || empty( $data[0]['lat'] ) || empty( $data[0]['lon'] ) ) {
			return null;
		}

		return array(
			'lat' => (string) $data[0]['lat'],
			'lon' => (string) $data[0]['lon'],
		);
	}
}
