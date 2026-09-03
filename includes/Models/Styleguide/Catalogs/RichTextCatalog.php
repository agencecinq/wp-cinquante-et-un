<?php
/**
 * Styleguide catalog: Rich text block variants.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide/Catalogs
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide\Catalogs;

use WPCinquanteEtUn\Models\Styleguide\StyleguideContext;
use WPCinquanteEtUn\Models\Styleguide\StyleguideEntry;

/**
 * RichTextCatalog
 */
class RichTextCatalog {

	/**
	 * Playground entry with all Rich text variants.
	 *
	 * @param StyleguideContext $context Shared fixtures.
	 * @return array<string, mixed>
	 */
	public static function entry( StyleguideContext $context ): array {
		return StyleguideEntry::playground(
			'styleguide-layout-rich-text',
			__( 'Rich text', 'wp-cinquante-et-un' ),
			'blocks/rich-text.html.twig',
			array(
				StyleguideEntry::variant(
					'prose-start',
					__( 'Prose · Start', 'wp-cinquante-et-un' ),
					$context->rich_text_block(
						'styleguide-rich-text-prose-start',
						array(
							'width'     => 'prose',
							'alignment' => 'start',
						)
					)
				),
				StyleguideEntry::variant(
					'wide-start',
					__( 'Wide · Start', 'wp-cinquante-et-un' ),
					$context->rich_text_block(
						'styleguide-rich-text-wide-start',
						array(
							'width'     => 'wide',
							'alignment' => 'start',
						)
					)
				),
				StyleguideEntry::variant(
					'full-start',
					__( 'Full width', 'wp-cinquante-et-un' ),
					$context->rich_text_block(
						'styleguide-rich-text-full',
						array(
							'width'     => 'full',
							'alignment' => 'start',
						)
					)
				),
				StyleguideEntry::variant(
					'prose-center',
					__( 'Prose · Center', 'wp-cinquante-et-un' ),
					$context->rich_text_block(
						'styleguide-rich-text-prose-center',
						array(
							'width'     => 'prose',
							'alignment' => 'center',
						)
					)
				),
			)
		);
	}
}
