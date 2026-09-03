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
use WPCinquanteEtUn\Models\Styleguide\Catalogs\KernelBlocksCatalog;
use WPCinquanteEtUn\Models\Styleguide\StyleguideContext;
use WPCinquanteEtUn\Models\Styleguide\StyleguideEntry;

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
		$context = new StyleguideContext( $this );
		$blocks  = KernelBlocksCatalog::entries( $context );

		StyleguideEntry::enrich_blocks( $blocks );

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
				'title' => __( 'Tag', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-tag',
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

		$shell = array(
			array(
				'title' => __( 'Editorial shell', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-editorial',
			),
			array(
				'title' => __( 'Search form', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-search-form',
			),
			array(
				'title' => __( 'Newsletter form', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-newsletter',
			),
			array(
				'title' => __( 'Breadcrumb', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-breadcrumb',
			),
			array(
				'title' => __( 'Taxonomy filters', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-filters',
			),
			array(
				'title' => __( 'Search result', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-search-result',
			),
			array(
				'title' => __( 'Social links', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-socials',
			),
			array(
				'title' => __( 'Page header', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-page-header',
			),
			array(
				'title' => __( 'Table of contents', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-toc',
			),
			array(
				'title' => __( 'Skip links', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-shell-skip-links',
			),
		);

		return array(
			array(
				'title' => __( 'Catalog', 'wp-cinquante-et-un' ),
				'items' => $catalog,
			),
			array(
				'title' => __( 'Shell', 'wp-cinquante-et-un' ),
				'items' => $shell,
			),
			array(
				'title' => __( 'Blocks', 'wp-cinquante-et-un' ),
				'items' => $layouts,
			),
		);
	}

	/**
	 * Dummy taxonomy filter links for the styleguide shell section.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function shell_filters(): array {
		return array(
			array(
				'title'  => __( 'All', 'wp-cinquante-et-un' ),
				'url'    => '#',
				'active' => true,
			),
			array(
				'title'  => __( 'Strategy', 'wp-cinquante-et-un' ),
				'url'    => '#',
				'active' => false,
			),
			array(
				'title'  => __( 'Performance', 'wp-cinquante-et-un' ),
				'url'    => '#',
				'active' => false,
			),
			array(
				'title'  => __( 'WordPress', 'wp-cinquante-et-un' ),
				'url'    => '#',
				'active' => false,
			),
		);
	}

	/**
	 * Dummy table-of-contents entries for the styleguide shell section.
	 *
	 * @return array<int, array{title: string, id: string}>
	 */
	public function shell_toc_items(): array {
		return array(
			array(
				'title' => __( 'Why ACF blocks', 'wp-cinquante-et-un' ),
				'id'    => 'why-acf-blocks',
			),
			array(
				'title' => __( 'Performance budgets', 'wp-cinquante-et-un' ),
				'id'    => 'performance-budgets',
			),
			array(
				'title' => __( 'Editor experience', 'wp-cinquante-et-un' ),
				'id'    => 'editor-experience',
			),
		);
	}

	/**
	 * Dummy social URLs for the styleguide shell section.
	 *
	 * @return array<string, array<string, string>>
	 */
	public function shell_socials(): array {
		return array(
			'facebook'  => array(
				'id'    => 'facebook',
				'title' => __( 'Facebook', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
			'instagram' => array(
				'id'    => 'instagram',
				'title' => __( 'Instagram', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
			'linkedin'  => array(
				'id'    => 'linkedin',
				'title' => __( 'LinkedIn', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
			'x'         => array(
				'id'    => 'x',
				'title' => __( 'X (Twitter)', 'wp-cinquante-et-un' ),
				'url'   => '#',
			),
		);
	}

	/**
	 * Dummy page object for the page header shell demo.
	 *
	 * @return object
	 */
	public function shell_page(): object {
		$title = __( 'Flexible page', 'wp-cinquante-et-un' );
		$lead  = __( 'Lead paragraph for pages whose first block is not a hero.', 'wp-cinquante-et-un' );

		return new class( $title, $lead ) {

			/**
			 * Page title.
			 *
			 * @var string
			 */
			public string $title;

			/**
			 * Page lead text.
			 *
			 * @var string
			 */
			private string $lead;

			/**
			 * Constructor.
			 *
			 * @param string $title Page title.
			 * @param string $lead  Page lead.
			 */
			public function __construct( string $title, string $lead ) {
				$this->title = $title;
				$this->lead  = $lead;
			}

			/**
			 * Returns ACF meta for the shell demo.
			 *
			 * @param string $key Field name.
			 * @return string
			 */
			public function meta( string $key ): string {
				return 'page_lead' === $key ? $this->lead : '';
			}
		};
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
		return StyleguideContext::placeholder_image( $width, $height );
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
