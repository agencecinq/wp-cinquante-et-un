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
		$layout = array(
			'paddings' => array(
				'top'    => 0,
				'bottom' => 0,
			),
		);
		$posts  = $this->posts();
		$image  = self::placeholder_image( 1600, 900 );
		$thumb  = self::placeholder_image( 800, 800 );
		$media  = array(
			'images' => array( $image ),
			'video'  => array(
				'file' => null,
			),
		);
		$link   = array(
			'title' => __( 'Talk about your project', 'wp-cinquante-et-un' ),
			'url'   => '#',
		);

		return array(
			array(
				'id'    => 'styleguide-layout-hero',
				'name'  => __( 'Hero', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/hero.html.twig',
				'block' => array(
					'id'             => 'styleguide-hero',
					'layout'         => $layout,
					'media'          => $media,
					'content'        => array(
						'title'   => __( 'A site that grows with you.', 'wp-cinquante-et-un' ),
						'heading' => 'h2',
						'link'    => $link,
					),
					'featured_posts' => array(
						'items' => $posts,
					),
					'footer'         => array(
						'items' => array(
							array(
								'title' => __( 'WordPress', 'wp-cinquante-et-un' ),
							),
							array(
								'title' => __( 'Timber', 'wp-cinquante-et-un' ),
							),
							array(
								'title' => __( 'Tailwind', 'wp-cinquante-et-un' ),
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
					'id'               => 'styleguide-media-text',
					'layout'           => $layout,
					'reveal_on_scroll' => false,
					'media'            => $media,
					'content'          => array(
						'title'       => __( 'Three ways to grow your site.', 'wp-cinquante-et-un' ),
						'heading'     => 'h2',
						'title_style' => 'text-4xl font-medium tracking-tight lg:text-6xl',
					),
				),
			),
			array(
				'id'    => 'styleguide-layout-media-text-reveal',
				'name'  => __( 'Media + text (reveal)', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/media-text.html.twig',
				'block' => array(
					'id'               => 'styleguide-media-text-reveal',
					'layout'           => $layout,
					'reveal_on_scroll' => true,
					'media'            => $media,
					'content'          => array(
						'title'       => __( 'A site that grows with you.', 'wp-cinquante-et-un' ),
						'heading'     => 'h2',
						'title_style' => 'text-4xl font-medium tracking-tight lg:text-6xl',
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
				'id'    => 'styleguide-layout-accordion-group',
				'name'  => __( 'Accordion Group', 'wp-cinquante-et-un' ),
				'file'  => 'blocks/accordion-group.html.twig',
				'block' => array(
					'id'         => 'styleguide-accordion-group',
					'layout'     => $layout,
					'radius'     => 'none',
					'content'    => array(
						'overline' => __( 'FAQ', 'wp-cinquante-et-un' ),
						'title'    => __( 'Questions we hear often.', 'wp-cinquante-et-un' ),
						'contact'  => array(
							'title' => __( 'Still need a hand?', 'wp-cinquante-et-un' ),
							'text'  => __( 'Write to us and we will find a time to talk.', 'wp-cinquante-et-un' ),
							'image' => $thumb,
							'link'  => $link,
						),
					),
					'accordions' => array(
						array(
							'header'  => __( 'What is in the starter?', 'wp-cinquante-et-un' ),
							'content' => __( 'Six layouts: accordion, columns, gallery, hero, latest posts, and media plus text.', 'wp-cinquante-et-un' ),
						),
						array(
							'header'  => __( 'Where do project compositions live?', 'wp-cinquante-et-un' ),
							'content' => __( 'On the project. A composition joins the starter only once it has been generalized.', 'wp-cinquante-et-un' ),
						),
						array(
							'header'  => __( 'How do I change the palette?', 'wp-cinquante-et-un' ),
							'content' => __( 'Override Tailwind tokens in theme.css, or add a token if the palette does not map.', 'wp-cinquante-et-un' ),
						),
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
						'overline' => __( 'Journal', 'wp-cinquante-et-un' ),
						'title'    => __( 'Latest posts', 'wp-cinquante-et-un' ),
						'category' => null,
					),
				),
			),
		);
	}

	/**
	 * In-page anchors for the catalog nav (foundations, components, layouts).
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function toc(): array {
		$catalog = array(
			array(
				'title' => __( 'Palette', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-colors',
			),
			array(
				'title' => __( 'Type', 'wp-cinquante-et-un' ),
				'href'  => '#styleguide-type',
			),
			array(
				'title' => __( 'Corners', 'wp-cinquante-et-un' ),
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
	 * Dummy posts for teasers (hero featured + latest posts).
	 *
	 * @return array<int, object>
	 */
	public function posts(): array {
		$thumbnail = self::placeholder_image( 800, 800 );
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
			'prev'  => array(
				'link' => '#',
			),
			'next'  => array(
				'link' => '#',
			),
			'pages' => array(
				array(
					'title' => '1',
					'link'  => '#',
					'class' => '',
				),
				array(
					'title' => '2',
					'link'  => '',
					'class' => 'current',
				),
				array(
					'title' => '3',
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
			public function date( string $format = 'c' ): string {
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
