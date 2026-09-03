<?php
/**
 * Styleguide catalog: Hero block variants.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide/Catalogs
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide\Catalogs;

use WPCinquanteEtUn\Models\Styleguide\StyleguideContext;
use WPCinquanteEtUn\Models\Styleguide\StyleguideEntry;

/**
 * HeroCatalog
 */
class HeroCatalog {

	/**
	 * Playground entry with all Hero variants.
	 *
	 * @param StyleguideContext $context Shared fixtures.
	 * @return array<string, mixed>
	 */
	public static function entry( StyleguideContext $context ): array {
		$media       = $context->hero_media();
		$media_video = StyleguideContext::placeholder_media_with_video(
			StyleguideContext::placeholder_image( 1600, 900 )
		);

		return StyleguideEntry::playground(
			'styleguide-layout-hero',
			__( 'Hero', 'wp-cinquante-et-un' ),
			'blocks/hero.html.twig',
			array(
				StyleguideEntry::variant(
					'left-standard',
					__( 'Align left · Standard', 'wp-cinquante-et-un' ),
					$context->hero_block(
						'styleguide-hero-left-standard',
						$media,
						array(
							'alignment'          => 'left',
							'height'             => 'standard',
							'show_media_overlay' => true,
						)
					)
				),
				StyleguideEntry::variant(
					'center-standard',
					__( 'Align center · Standard', 'wp-cinquante-et-un' ),
					$context->hero_block(
						'styleguide-hero-center-standard',
						$media,
						array(
							'alignment'          => 'center',
							'height'             => 'standard',
							'show_media_overlay' => true,
						)
					)
				),
				StyleguideEntry::variant(
					'left-compact',
					__( 'Align left · Compact', 'wp-cinquante-et-un' ),
					$context->hero_block(
						'styleguide-hero-left-compact',
						$media,
						array(
							'alignment'          => 'left',
							'height'             => 'compact',
							'show_media_overlay' => true,
						)
					)
				),
				StyleguideEntry::variant(
					'left-full',
					__( 'Align left · Full viewport', 'wp-cinquante-et-un' ),
					$context->hero_block(
						'styleguide-hero-left-full',
						$media,
						array(
							'alignment'          => 'left',
							'height'             => 'full',
							'show_media_overlay' => true,
						)
					)
				),
				StyleguideEntry::variant(
					'left-no-overlay',
					__( 'Align left · No overlay', 'wp-cinquante-et-un' ),
					$context->hero_block(
						'styleguide-hero-left-no-overlay',
						$media,
						array(
							'alignment'          => 'left',
							'height'             => 'standard',
							'show_media_overlay' => false,
						)
					)
				),
				StyleguideEntry::variant(
					'left-video',
					__( 'Align left · Desktop video', 'wp-cinquante-et-un' ),
					$context->hero_block(
						'styleguide-hero-left-video',
						$media_video,
						array(
							'alignment'          => 'left',
							'height'             => 'standard',
							'show_media_overlay' => true,
						)
					)
				),
			)
		);
	}
}
