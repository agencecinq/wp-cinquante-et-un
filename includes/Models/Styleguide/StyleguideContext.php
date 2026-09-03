<?php
/**
 * Shared fixtures for styleguide block catalogs.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide;

use WPCinquanteEtUn\Models\StyleguidePage;

/**
 * Layout presets, placeholders, and sample posts for kernel block demos.
 */
class StyleguideContext {

	/**
	 * Parent page model (posts(), pagination(), etc.).
	 *
	 * @var StyleguidePage
	 */
	private StyleguidePage $page;

	/**
	 * Constructor.
	 *
	 * @param StyleguidePage $page Styleguide page model.
	 */
	public function __construct( StyleguidePage $page ) {
		$this->page = $page;
	}

	/**
	 * Default section layout preset.
	 *
	 * @return array<string, string>
	 */
	public function layout(): array {
		return array(
			'color_scheme'   => 'default',
			'spacing_top'    => 'md',
			'spacing_bottom' => 'md',
		);
	}

	/**
	 * Flush section layout (hero and full-bleed demos).
	 *
	 * @return array<string, string>
	 */
	public function layout_flush(): array {
		return array(
			'color_scheme'   => 'default',
			'spacing_top'    => 'none',
			'spacing_bottom' => 'none',
		);
	}

	/**
	 * Inverse CTA section layout.
	 *
	 * @return array<string, string>
	 */
	public function layout_cta(): array {
		return array(
			'color_scheme'   => 'inverse',
			'spacing_top'    => 'xl',
			'spacing_bottom' => 'xl',
		);
	}

	/**
	 * Sample posts for the latest posts block.
	 *
	 * @return array<int, object>
	 */
	public function posts(): array {
		return $this->page->posts();
	}

	/**
	 * Placeholder image array consumed by image.html.twig.
	 *
	 * @param int $width  Intrinsic width.
	 * @param int $height Intrinsic height.
	 * @return array<string, mixed>
	 */
	public static function placeholder_image( int $width, int $height ): array {
		return array(
			'src'         => get_theme_file_uri( 'public/placeholder.svg' ),
			'alt'         => __( 'Placeholder', 'wp-cinquante-et-un' ),
			'width'       => $width,
			'height'      => $height,
			'placeholder' => true,
		);
	}

	/**
	 * Media clone with bundled placeholder video (desktop) and image fallback (mobile).
	 *
	 * @param array<string, mixed> $image Placeholder image.
	 * @return array<string, mixed>
	 */
	public static function placeholder_media_with_video( array $image ): array {
		return array(
			'images' => array( $image ),
			'video'  => array(
				'file'   => array(
					'url' => get_theme_file_uri( 'public/placeholder.mp4' ),
				),
				'poster' => array(
					'url' => $image['src'],
				),
			),
		);
	}

	/**
	 * Hero media clone with image only.
	 *
	 * @return array<string, mixed>
	 */
	public function hero_media(): array {
		$image = self::placeholder_image( 1600, 900 );

		return array(
			'images' => array( $image ),
			'video'  => array(
				'file' => null,
			),
		);
	}

	/**
	 * Shared hero content group.
	 *
	 * @return array<string, mixed>
	 */
	public function hero_content(): array {
		return array(
			'overline'       => __( 'WordPress agency', 'wp-cinquante-et-un' ),
			'title'          => __( 'Sites your team can actually run', 'wp-cinquante-et-un' ),
			'heading'        => 'h1',
			'text'           => __( 'Custom theme, ACF blocks, no page builder. You edit the content; we step in when the code has to move.', 'wp-cinquante-et-un' ),
			'link'           => array(
				'title' => __( 'Let\'s talk about your project', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
			'secondary_link' => array(
				'title' => __( 'See our work', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
		);
	}

	/**
	 * Builds a hero block row merged with overrides.
	 *
	 * @param string               $block_id  Block anchor slug.
	 * @param array<string, mixed> $media     Media clone value.
	 * @param array<string, mixed> $overrides Field overrides.
	 * @return array<string, mixed>
	 */
	public function hero_block( string $block_id, array $media, array $overrides = array() ): array {
		return array_merge(
			array(
				'id'      => $block_id,
				'layout'  => $this->layout_flush(),
				'media'   => $media,
				'content' => $this->hero_content(),
			),
			$overrides
		);
	}

	/**
	 * Shared media + text demo fields.
	 *
	 * @return array<string, mixed>
	 */
	public function media_text_common(): array {
		return array(
			'media'       => self::placeholder_image( 1200, 900 ),
			'media_ratio' => '4:3',
			'overline'    => __( 'Performance', 'wp-cinquante-et-un' ),
			'title'       => __( 'Core Web Vitals in the green, from day one', 'wp-cinquante-et-un' ),
			'content'     => '<p>' . esc_html__(
				'No catch-up six months later. Performance budgets are set at kickoff and checked every sprint: image weight, font loading, deferred JavaScript.',
				'wp-cinquante-et-un'
			) . '</p>',
			'cta'         => array(
				'title' => __( 'Our technical approach', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
		);
	}

	/**
	 * Builds a media + text block row merged with overrides.
	 *
	 * @param string               $block_id  Block anchor slug.
	 * @param array<string, mixed> $overrides Field overrides.
	 * @return array<string, mixed>
	 */
	public function media_text_block( string $block_id, array $overrides = array() ): array {
		return array_merge(
			array(
				'id'     => $block_id,
				'layout' => $this->layout(),
			),
			$this->media_text_common(),
			$overrides
		);
	}

	/**
	 * Shared rich text body markup.
	 *
	 * @return string
	 */
	public function rich_text_body(): string {
		return '<p>' . esc_html__(
			'This theme is intentionally minimal. Replace the copy, wire up your menus, then build project sections on top of this base.',
			'wp-cinquante-et-un'
		) . '</p>';
	}

	/**
	 * Builds a rich text block row merged with overrides.
	 *
	 * @param string               $block_id  Block anchor slug.
	 * @param array<string, mixed> $overrides Field overrides.
	 * @return array<string, mixed>
	 */
	public function rich_text_block( string $block_id, array $overrides = array() ): array {
		return array_merge(
			array(
				'id'        => $block_id,
				'layout'    => $this->layout(),
				'overline'  => __( 'Intro', 'wp-cinquante-et-un' ),
				'title'     => __( 'Starting point', 'wp-cinquante-et-un' ),
				'content'   => $this->rich_text_body(),
				'width'     => 'prose',
				'alignment' => 'start',
			),
			$overrides
		);
	}
}
