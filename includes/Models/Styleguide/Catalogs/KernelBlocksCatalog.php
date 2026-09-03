<?php
/**
 * Styleguide catalog: ordered kernel block entries.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide/Catalogs
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide\Catalogs;

use WPCinquanteEtUn\Models\Styleguide\StyleguideContext;

/**
 * KernelBlocksCatalog
 */
class KernelBlocksCatalog {

	/**
	 * All kernel layouts in catalog display order.
	 *
	 * @param StyleguideContext $context Shared fixtures.
	 * @return array<int, array<string, mixed>>
	 */
	public static function entries( StyleguideContext $context ): array {
		$standard = array_column(
			StandardBlocksCatalog::entries( $context ),
			null,
			'id'
		);

		return array(
			HeroCatalog::entry( $context ),
			$standard['styleguide-layout-logos'],
			$standard['styleguide-layout-cards-grid'],
			MediaTextCatalog::entry( $context ),
			$standard['styleguide-layout-key-figures'],
			$standard['styleguide-layout-case-studies'],
			$standard['styleguide-layout-testimonials'],
			$standard['styleguide-layout-team'],
			$standard['styleguide-layout-accordion-group'],
			$standard['styleguide-layout-form'],
			$standard['styleguide-layout-contact'],
			$standard['styleguide-layout-cta'],
			RichTextCatalog::entry( $context ),
			$standard['styleguide-layout-columns'],
			$standard['styleguide-layout-gallery'],
			$standard['styleguide-layout-latest-posts'],
		);
	}
}
