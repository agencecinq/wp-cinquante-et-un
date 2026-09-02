<?php
/**
 * Styleguide page model
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\Post;

/**
 * StyleguidePage
 *
 * Page model for the Styleguide page template (timber/post/classmap).
 * Dummy data for kernel blocks, placeholder images, and sample posts.
 */
class StyleguidePage extends Post {

	/**
	 * Kernel blocks with sample content, ready to include their production Twig.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function blocks(): array {
		$layout       = array(
			'color_scheme'   => 'default',
			'spacing_top'    => 'md',
			'spacing_bottom' => 'md',
		);
		$layout_flush = array(
			'color_scheme'   => 'default',
			'spacing_top'    => 'none',
			'spacing_bottom' => 'none',
		);
		$layout_cta   = array(
			'color_scheme'   => 'inverse',
			'spacing_top'    => 'xl',
			'spacing_bottom' => 'xl',
		);
		$posts        = $this->posts();
		$image        = self::placeholder_image( 1600, 900 );
		$media        = array(
			'images' => array( $image ),
			'video'  => array(
				'file' => null,
			),
		);
		$logo         = self::placeholder_image( 150, 32 );
		$avatar       = self::placeholder_image( 80, 80 );

		$blocks = array(
			array(
				'id'    => 'styleguide-layout-hero',
				'name'  => __( 'Hero', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/hero.html.twig',
				'block' => array(
					'id'                 => 'styleguide-hero',
					'layout'             => $layout_flush,
					'media'              => $media,
					'show_media_overlay' => false,
					'content'            => array(
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
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-logos',
				'name'  => __( 'Logos', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/logos.html.twig',
				'block' => array(
					'id'        => 'styleguide-logos',
					'layout'    => $layout,
					'title'     => __( 'They trust us', 'wp-cinquante-et-un' ),
					'grayscale' => true,
					'logos'     => array( $logo, $logo, $logo, $logo, $logo, $logo ),
				),
			),
			array(
				'id'    => 'styleguide-layout-cards-grid',
				'name'  => __( 'Cards Grid', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/cards-grid.html.twig',
				'block' => array(
					'id'      => 'styleguide-cards-grid',
					'layout'  => $layout,
					'columns' => 3,
					'content' => array(
						'overline' => __( 'Expertise', 'wp-cinquante-et-un' ),
						'title'    => __( 'What we do', 'wp-cinquante-et-un' ),
					),
					'cards'   => array(
						array(
							'icon'  => null,
							'title' => __( 'Site build', 'wp-cinquante-et-un' ),
							'text'  => __( 'Custom Timber theme, tailored ACF blocks. In your Git repo from the first commit.', 'wp-cinquante-et-un' ),
							'link'  => array(
								'title' => __( 'Our method', 'wp-cinquante-et-un' ),
								'url'   => '#',
							),
						),
						array(
							'icon'  => null,
							'title' => __( 'Redesign', 'wp-cinquante-et-un' ),
							'text'  => __( 'Page by page, with the editorial structure rebuilt. Content and SEO are kept.', 'wp-cinquante-et-un' ),
							'link'  => array(
								'title' => __( 'Our method', 'wp-cinquante-et-un' ),
								'url'   => '#',
							),
						),
						array(
							'icon'  => null,
							'title' => __( 'Maintenance', 'wp-cinquante-et-un' ),
							'text'  => __( 'Updates, backups, monitoring, and retainers. Corrective hotfixes follow the SLA.', 'wp-cinquante-et-un' ),
							'link'  => array(
								'title' => __( 'Our method', 'wp-cinquante-et-un' ),
								'url'   => '#',
							),
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-media-text',
				'name'  => __( 'Media + text', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/media-text.html.twig',
				'block' => array(
					'id'             => 'styleguide-media-text',
					'layout'         => $layout,
					'media_position' => 'left',
					'media'          => $media,
					'content'        => array(
						'overline' => __( 'Performance', 'wp-cinquante-et-un' ),
						'title'    => __( 'Core Web Vitals in the green, from day one', 'wp-cinquante-et-un' ),
						'heading'  => 'h2',
						'text'     => '<p>' . esc_html__( 'No catch-up six months later. Performance budgets are set at kickoff and checked every sprint: image weight, font loading, deferred JavaScript.', 'wp-cinquante-et-un' ) . '</p>',
						'link'     => array(
							'title' => __( 'Our technical approach', 'wp-cinquante-et-un' ),
							'url'   => '#',
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-key-figures',
				'name'  => __( 'Key Figures', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/key-figures.html.twig',
				'block' => array(
					'id'      => 'styleguide-key-figures',
					'layout'  => $layout,
					'content' => array(
						'overline' => __( 'Results', 'wp-cinquante-et-un' ),
						'title'    => __( 'What it changes, in practice', 'wp-cinquante-et-un' ),
					),
					'figures' => array(
						array(
							'value'  => '+68',
							'suffix' => '%',
							'label'  => __( 'more quote requests in six months', 'wp-cinquante-et-un' ),
						),
						array(
							'value'  => '1.4',
							'suffix' => 's',
							'label'  => __( 'median LCP on mobile', 'wp-cinquante-et-un' ),
						),
						array(
							'value'  => '95',
							'suffix' => '+',
							'label'  => __( 'PageSpeed score on mobile', 'wp-cinquante-et-un' ),
						),
						array(
							'value'  => '0',
							'suffix' => '',
							'label'  => __( 'page builder plugins', 'wp-cinquante-et-un' ),
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-case-studies',
				'name'  => __( 'Case Studies', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/case-studies.html.twig',
				'block' => array(
					'id'      => 'styleguide-case-studies',
					'layout'  => $layout,
					'content' => array(
						'overline' => __( 'Work', 'wp-cinquante-et-un' ),
						'title'    => __( 'Projects that last', 'wp-cinquante-et-un' ),
						'link'     => array(
							'title' => __( 'All case studies', 'wp-cinquante-et-un' ),
							'url'   => '#',
						),
					),
					'items'   => array(
						array(
							'image'        => $image,
							'sector'       => __( 'Industry', 'wp-cinquante-et-un' ),
							'client'       => 'Nexiode',
							'title'        => __( 'Corporate site and configurator rebuild', 'wp-cinquante-et-un' ),
							'url'          => '#',
							'result_value' => '+68 %',
							'result_label' => __( 'quote requests', 'wp-cinquante-et-un' ),
						),
						array(
							'image'        => $image,
							'sector'       => __( 'Industry', 'wp-cinquante-et-un' ),
							'client'       => 'Laffargue',
							'title'        => __( 'Editorial platform and dealer space', 'wp-cinquante-et-un' ),
							'url'          => '#',
							'result_value' => '1.4 s',
							'result_label' => __( 'LCP on mobile', 'wp-cinquante-et-un' ),
						),
						array(
							'image'        => $image,
							'sector'       => __( 'Industry', 'wp-cinquante-et-un' ),
							'client'       => 'Beau Nuage',
							'title'        => __( 'Brochure site rebuild', 'wp-cinquante-et-un' ),
							'url'          => '#',
							'result_value' => '2.3x',
							'result_label' => __( 'conversion rate', 'wp-cinquante-et-un' ),
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-testimonials',
				'name'  => __( 'Testimonials', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/testimonials.html.twig',
				'block' => array(
					'id'      => 'styleguide-testimonials',
					'layout'  => $layout,
					'content' => array(
						'overline' => __( 'Client feedback', 'wp-cinquante-et-un' ),
						'title'    => __( 'What they say', 'wp-cinquante-et-un' ),
					),
					'items'   => array(
						array(
							'quote'   => __( 'They refused the easy option and took the time to understand our work. The back office is finally usable by the communications team.', 'wp-cinquante-et-un' ),
							'author'  => 'Sophie Lemarchand',
							'role'    => __( 'Communications director', 'wp-cinquante-et-un' ),
							'company' => 'Nexiode',
							'avatar'  => $avatar,
						),
						array(
							'quote'   => __( 'The site went from 4.2 s to 1.4 s load time. Quote requests followed, without touching the ad budget.', 'wp-cinquante-et-un' ),
							'author'  => 'Marc Vandenberghe',
							'role'    => __( 'Managing director', 'wp-cinquante-et-un' ),
							'company' => 'Laffargue',
							'avatar'  => $avatar,
						),
						array(
							'quote'   => __( 'Three years after launch, we still edit everything ourselves. No lock-in, no surprise invoices.', 'wp-cinquante-et-un' ),
							'author'  => 'Ines Bakouche',
							'role'    => __( 'Marketing lead', 'wp-cinquante-et-un' ),
							'company' => 'Zeta',
							'avatar'  => $avatar,
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-accordion-group',
				'name'  => __( 'FAQ', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/accordion-group.html.twig',
				'block' => array(
					'id'              => 'styleguide-accordion-group',
					'acf_fc_layout'   => 'accordion_group',
					'layout'          => $layout,
					'schema'     => true,
					'content'    => array(
						'overline' => __( 'FAQ', 'wp-cinquante-et-un' ),
						'title'    => __( 'What we get asked most', 'wp-cinquante-et-un' ),
					),
					'accordions' => array(
						array(
							'header'  => __( 'How long does a redesign take?', 'wp-cinquante-et-un' ),
							'content' => __( 'Eight to twelve weeks for a brochure site of about thirty pages, including scoping. The bottleneck is almost never development: it is content production.', 'wp-cinquante-et-un' ),
						),
						array(
							'header'  => __( 'Can you take over an existing site?', 'wp-cinquante-et-un' ),
							'content' => __( 'Yes. We audit the theme, plugins, and content, then rebuild what cannot be maintained. URLs and SEO are mapped before anything goes live.', 'wp-cinquante-et-un' ),
						),
						array(
							'header'  => __( 'What happens after launch?', 'wp-cinquante-et-un' ),
							'content' => __( 'You edit the content. We stay on for updates, backups, and the work that needs code. The retainer matches the SLA, not a surprise invoice.', 'wp-cinquante-et-un' ),
						),
						array(
							'header'  => __( 'Do you work with third-party plugins?', 'wp-cinquante-et-un' ),
							'content' => __( 'ACF is the only plugin in the kernel. Project adapters (forms, SEO, CRM) are wired per site, not baked into the starter.', 'wp-cinquante-et-un' ),
						),
						array(
							'header'  => __( 'Do we really own the code?', 'wp-cinquante-et-un' ),
							'content' => __( 'Yes. The theme lives in your Git repository from the first commit. No page builder, no proprietary lock-in.', 'wp-cinquante-et-un' ),
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-form',
				'name'  => __( 'Form', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/form.html.twig',
				'block' => array(
					'id'      => 'styleguide-form',
					'layout'  => $layout,
					'content' => array(
						'overline' => __( 'Contact', 'wp-cinquante-et-un' ),
						'title'    => __( 'Let\'s talk about your project', 'wp-cinquante-et-un' ),
						'text'     => __( 'Describe your need in a few lines. We reply within two business days, and the first call is always free.', 'wp-cinquante-et-un' ),
					),
					'form'    => null,
				),
			),
			array(
				'id'    => 'styleguide-layout-cta',
				'name'  => __( 'CTA', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/cta.html.twig',
				'block' => array(
					'id'      => 'styleguide-cta',
					'layout'  => $layout_cta,
					'content' => array(
						'title'   => __( 'A new site or a redesign?', 'wp-cinquante-et-un' ),
						'heading' => 'h2',
						'text'    => __( 'Thirty minutes is enough to know if we are the right partner. No commitment, and no sales pitch.', 'wp-cinquante-et-un' ),
						'link'    => array(
							'title' => __( 'Book a call', 'wp-cinquante-et-un' ),
							'url'   => '#',
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-rich-text',
				'name'  => __( 'Rich text', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/rich-text.html.twig',
				'block' => array(
					'id'      => 'styleguide-rich-text',
					'layout'  => $layout,
					'content' => array(
						'overline'       => __( 'Intro', 'wp-cinquante-et-un' ),
						'title'          => __( 'Starting point', 'wp-cinquante-et-un' ),
						'heading'        => 'h2',
						'text'           => '<p>' . esc_html__( 'This theme is intentionally minimal. Replace the copy, wire up your menus, then build project sections on top of this base.', 'wp-cinquante-et-un' ) . '</p>',
						'text_alignment' => 'text-left',
						'link'           => array(
							'title' => __( 'Contact page', 'wp-cinquante-et-un' ),
							'url'   => '#',
						),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-columns',
				'name'  => __( 'Columns', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/columns.html.twig',
				'block' => array(
					'id'      => 'styleguide-columns',
					'layout'  => $layout,
					'content' => array(
						'column_left'  => '<p>' . esc_html__( 'Your site is not an expense to write off every three years.', 'wp-cinquante-et-un' ) . '</p>',
						'column_right' => '<p>' . esc_html__( 'It is an asset you build to last, and you evolve it with the company.', 'wp-cinquante-et-un' ) . '</p>',
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-gallery',
				'name'  => __( 'Gallery', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/gallery.html.twig',
				'block' => array(
					'id'             => 'styleguide-gallery',
					'layout'         => $layout,
					'marquee'        => false,
					'images_per_row' => 4,
					'content'        => array(
						'title'   => __( 'Gallery', 'wp-cinquante-et-un' ),
						'gallery' => array( $image, $image, $image, $image ),
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-latest-posts',
				'name'  => __( 'Latest posts', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/latest-posts.html.twig',
				'block' => array(
					'id'      => 'styleguide-latest-posts',
					'layout'  => $layout,
					'posts'   => $posts,
					'content' => array(
						'overline'       => __( 'Journal', 'wp-cinquante-et-un' ),
						'title'          => __( 'Latest posts', 'wp-cinquante-et-un' ),
						'category'       => null,
						'posts_per_page' => 4,
						'link'           => array(
							'title' => __( 'View all posts', 'wp-cinquante-et-un' ),
							'url'   => '#',
						),
					),
				),
			),
		);

		foreach ( $blocks as &$entry ) {
			if ( isset( $entry['block'] ) && is_array( $entry['block'] ) ) {
				cinq_enrich_block( $entry['block'] );
			}
		}
		unset( $entry );

		return $blocks;
	}

	/**
	 * In-page anchors for the catalog nav (foundations, components, layouts).
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function toc(): array {
		$catalog = array(
			array(
				'title' => __( 'Colour', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-colors',
			),
			array(
				'title' => __( 'Type', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-type',
			),
			array(
				'title' => __( 'Space', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-space',
			),
			array(
				'title' => __( 'Layout', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-layout',
			),
			array(
				'title' => __( 'Radius', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-radius',
			),
			array(
				'title' => __( 'Buttons', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-buttons',
			),
			array(
				'title' => __( 'Chip and tag', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-chips',
			),
			array(
				'title' => __( 'Icons', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-icons',
			),
			array(
				'title' => __( 'Image', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-image',
			),
			array(
				'title' => __( 'Teasers', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-teasers',
			),
			array(
				'title' => __( 'Pagination', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-pagination',
			),
			array(
				'title' => __( 'WYSIWYG', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-wysiwyg',
			),
			array(
				'title' => __( 'Web Components', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-ui',
			),
		);

		$layouts = array();

		foreach ( $this->blocks() as $item ) {
			$layouts[] = array(
				'title' => $item['name'],
				'href'  => '#' . $item['id'],
			);
		}

		return array(
			array(
				'title' => __( 'Catalog', 'wp-cinquante-et-un' ),
				'items' => $catalog,
			),
			array(
				'title' => __( 'Blocks', 'wp-cinquante-et-un' ),
				'items' => $layouts,
			),
		);
	}

	/**
	 * Dummy posts for teasers (latest posts grid).
	 *
	 * @return array<int, object>
	 */
	public function posts(): array {
		$thumbnail = self::placeholder_image( 900, 600 );
		$category  = (object) array(
			'name' => __( 'Journal', 'wp-cinquante-et-un' ),
		);
		$author    = (object) array(
			'name' => 'CINQ',
		);
		$date      = '2026-01-15 10:00:00';
		$samples   = array(
			array(
				'title'   => __( 'Five commitments. None negotiable.', 'wp-cinquante-et-un' ),
				'excerpt' => __( 'Dedicated theme, D2C and B2B, CRM connected from day one.', 'wp-cinquante-et-un' ),
			),
			array(
				'title'   => __( 'A site that grows with you.', 'wp-cinquante-et-un' ),
				'excerpt' => __( 'It is an asset you build to last, and you evolve it with the company.', 'wp-cinquante-et-un' ),
			),
			array(
				'title'   => __( 'Maintenance and evolutions', 'wp-cinquante-et-un' ),
				'excerpt' => __( 'Fast, maintainable WordPress brochure and editorial sites.', 'wp-cinquante-et-un' ),
			),
			array(
				'title'   => __( 'Primitives, not a finished site', 'wp-cinquante-et-un' ),
				'excerpt' => __( 'Hero, rich text, latest posts, and accordion. No cart, no products.', 'wp-cinquante-et-un' ),
			),
		);

		$posts = array();

		foreach ( $samples as $sample ) {
			$posts[] = $this->dummy_post(
				array(
					'title'      => $sample['title'],
					'link'       => '#',
					'excerpt'    => $sample['excerpt'],
					'thumbnail'  => $thumbnail,
					'categories' => array( $category ),
					'author'     => $author,
					'date'       => $date,
				)
			);
		}

		return $posts;
	}

	/**
	 * Dummy pagination shaped like Timber\PostCollection::pagination().
	 *
	 * @return array<string, mixed>
	 */
	public function pagination(): array {
		return array(
			'prev'  => array(),
			'next'  => array(
				'link' => '#',
			),
			'pages' => array(
				array(
					'title' => '1',
					'link'  => '',
					'class' => 'current',
				),
				array(
					'title' => '2',
					'link'  => '#',
					'class' => '',
				),
				array(
					'title' => '3',
					'link'  => '#',
					'class' => '',
				),
				array(
					'title' => '…',
					'link'  => '',
					'class' => '',
				),
				array(
					'title' => '8',
					'link'  => '#',
					'class' => '',
				),
			),
		);
	}

	/**
	 * Placeholder image array consumed by image.html.twig (no attachment required).
	 *
	 * @param int $width  Intrinsic width.
	 * @param int $height Intrinsic height.
	 * @return array<string, mixed>
	 */
	public static function placeholder_image( int $width, int $height ): array {
		return array(
			'src'         => get_theme_file_uri( 'src/img/svg/placeholder.svg' ),
			'alt'         => __( 'Placeholder', 'wp-cinquante-et-un' ),
			'width'       => $width,
			'height'      => $height,
			'placeholder' => true,
		);
	}

	/**
	 * Placeholder tiles for the image.html.twig contract (src, alt, width, height, placeholder).
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function images(): array {
		return array(
			array(
				'label' => '1600 × 900',
				'image' => self::placeholder_image( 1600, 900 ),
			),
			array(
				'label' => '800 × 800',
				'image' => self::placeholder_image( 800, 800 ),
			),
		);
	}

	/**
	 * Dummy post shaped like Timber\Post for tease-post templates.
	 *
	 * @param array<string, mixed> $data Dummy post fields.
	 * @return object
	 */
	private function dummy_post( array $data ): object {
		return new class( $data ) {

			/**
			 * Post title.
			 *
			 * @var string
			 */
			public string $title;

			/**
			 * Permalink.
			 *
			 * @var string
			 */
			public string $link;

			/**
			 * Thumbnail placeholder passed to image.html.twig.
			 *
			 * @var array<string, mixed>
			 */
			public array $thumbnail;

			/**
			 * Categories (objects with a name property).
			 *
			 * @var array<int, object>
			 */
			public array $categories;

			/**
			 * Author (object with a name property).
			 *
			 * @var object
			 */
			public object $author;

			/**
			 * Excerpt text.
			 *
			 * @var string
			 */
			private string $excerpt;

			/**
			 * Date used for published and modified.
			 *
			 * @var string
			 */
			private string $datetime;

			/**
			 * Constructor.
			 *
			 * @param array<string, mixed> $data Dummy post fields.
			 */
			public function __construct( array $data ) {
				$this->title      = $data['title'];
				$this->link       = $data['link'];
				$this->excerpt    = $data['excerpt'];
				$this->thumbnail  = $data['thumbnail'];
				$this->categories = $data['categories'];
				$this->author     = $data['author'];
				$this->datetime   = $data['date'];
			}

			/**
			 * Returns the excerpt. Signature matches Timber\Post::excerpt() usage in Twig.
			 *
			 * @param array<string, mixed> $args Excerpt options (chars).
			 * @return string
			 */
			public function excerpt( array $args = array() ): string {
				$chars = isset( $args['chars'] ) ? (int) $args['chars'] : 0;

				if ( $chars > 0 ) {
					return wp_html_excerpt( $this->excerpt, $chars );
				}

				return $this->excerpt;
			}

			/**
			 * Formatted published date.
			 *
			 * @param string $format PHP date format.
			 * @return string
			 */
			public function date( string $format = '' ): string {
				if ( '' === $format ) {
					$format = (string) get_option( 'date_format' );
				}

				return wp_date( $format, strtotime( $this->datetime ) );
			}

			/**
			 * Formatted modified date.
			 *
			 * @param string $format PHP date format.
			 * @return string
			 */
			public function modified( string $format = 'c' ): string {
				return $this->date( $format );
			}
		};
	}
}
