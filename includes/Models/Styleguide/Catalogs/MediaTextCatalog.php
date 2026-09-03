<?php
/**
 * Styleguide catalog: Media + text block variants.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide/Catalogs
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide\Catalogs;

use WPCinquanteEtUn\Models\Styleguide\StyleguideContext;
use WPCinquanteEtUn\Models\Styleguide\StyleguideEntry;

/**
 * MediaTextCatalog
 */
class MediaTextCatalog {

	/**
	 * Playground entry with all Media + text variants.
	 *
	 * @param StyleguideContext $context Shared fixtures.
	 * @return array<string, mixed>
	 */
	public static function entry( StyleguideContext $context ): array {
		return StyleguideEntry::playground(
			'styleguide-layout-media-text',
			__( 'Media + text', 'wp-cinquante-et-un' ),
			'blocks/media-text.html.twig',
			array(
				StyleguideEntry::variant(
					'media-left',
					__( 'Media left', 'wp-cinquante-et-un' ),
					$context->media_text_block(
						'styleguide-media-text-left',
						array(
							'media_position' => 'left',
						)
					)
				),
				StyleguideEntry::variant(
					'media-right',
					__( 'Media right', 'wp-cinquante-et-un' ),
					$context->media_text_block(
						'styleguide-media-text-right',
						array(
							'media_position' => 'right',
						)
					)
				),
				StyleguideEntry::variant(
					'ratio-square',
					__( 'Ratio 1:1', 'wp-cinquante-et-un' ),
					$context->media_text_block(
						'styleguide-media-text-square',
						array(
							'media_position' => 'left',
							'media_ratio'    => '1:1',
						)
					)
				),
			)
		);
	}
}
