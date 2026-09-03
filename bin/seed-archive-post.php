<?php
/**
 * Seed the posts archive and single-post demo content (Figma nodes 3:106, 29:2).
 *
 * Usage (Local site running):
 * wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-archive-post.php \
 *   --path=/path/to/wordpress/public
 *
 * @package WPCinquanteEtUn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/seed-helpers.php';

if ( ! function_exists( 'update_field' ) ) {
	WP_CLI::error( 'Advanced Custom Fields must be active.' );
}

/**
 * Returns archive options content from the Figma reference.
 *
 * @return array<string, mixed>
 */
function cinq_seed_archive_posts_options(): array {
	$layout_cta = cinq_seed_layout( 'xl', 'xl', 'inverse' );

	return array(
		'hero'   => array(
			'title' => 'Le journal',
			'text'  => 'Ce qu\'on apprend en construisant des sites : méthode, technique, et les arbitrages qu\'on assume.',
		),
		'blocks' => array(
			array(
				'acf_fc_layout' => 'cta',
				'layout'        => $layout_cta,
				'title'         => 'Un projet de site ou de refonte ?',
				'text'          => 'Un premier échange de trente minutes suffit à savoir si nous sommes le bon partenaire. Sans engagement, et sans présentation commerciale.',
				'cta_primary'   => cinq_seed_link( 'Prendre rendez-vous', '#contact' ),
			),
		),
	);
}

$journal_page = get_page_by_path( 'journal' );

if ( ! $journal_page ) {
	$journal_page_id = wp_insert_post(
		array(
			'post_title'  => 'Journal',
			'post_name'   => 'journal',
			'post_status' => 'publish',
			'post_type'   => 'page',
		),
		true
	);

	if ( is_wp_error( $journal_page_id ) ) {
		WP_CLI::error( $journal_page_id->get_error_message() );
	}
} else {
	$journal_page_id = (int) $journal_page->ID;
}

update_option( 'page_for_posts', $journal_page_id );
update_option( 'show_on_front', get_option( 'page_on_front' ) ? 'page' : get_option( 'show_on_front' ) );

update_field( 'archive_posts', cinq_seed_archive_posts_options(), 'option' );

$author_id = cinq_seed_get_or_create_author();

$category_ids = array(
	'strategie'     => cinq_seed_category( 'Stratégie', 'strategie' ),
	'design'        => cinq_seed_category( 'Design', 'design' ),
	'developpement' => cinq_seed_category( 'Développement', 'developpement' ),
	'seo'           => cinq_seed_category( 'SEO', 'seo' ),
	'methode'       => cinq_seed_category( 'Méthode', 'methode' ),
	'technique'     => cinq_seed_category( 'Technique', 'technique' ),
	'performance'   => cinq_seed_category( 'Performance', 'performance' ),
	'conformite'    => cinq_seed_category( 'Conformité', 'conformite' ),
);

$tag_ids = array(
	'wordpress'   => cinq_seed_post_tag( 'WordPress', 'wordpress' ),
	'acf'         => cinq_seed_post_tag( 'ACF', 'acf' ),
	'performance' => cinq_seed_post_tag( 'Performance', 'performance' ),
);

WP_CLI::log( 'Sideloading post thumbnails…' );

$demo_posts = array(
	array(
		'title'        => 'Pourquoi nous refusons les page builders',
		'slug'         => 'pourquoi-nous-refusons-les-page-builders',
		'excerpt'      => 'Elementor et Divi promettent l\'autonomie et livrent de la dette technique. Ce qu\'on gagne vraiment à écrire le code soi-même.',
		'category_id'  => $category_ids['methode'],
		'seed'         => 'cinq-post-1',
		'image_size'   => '1400/700',
		'post_date'    => '2026-03-12 10:00:00',
		'author_id'    => $author_id,
		'content'      => cinq_seed_page_builders_post_content(),
		'tag_ids'      => array( $tag_ids['wordpress'], $tag_ids['acf'], $tag_ids['performance'] ),
		'reading_time' => 7,
	),
	array(
		'title'       => 'Comment migrer un site WordPress sans perdre le SEO',
		'slug'        => 'migrer-un-site-wordpress-sans-perdre-le-seo',
		'excerpt'     => 'Le SEO ne se limite pas aux URLs : contenus, maillage et redirections doivent être cartographiés avant la bascule.',
		'category_id' => $category_ids['technique'],
		'seed'        => 'cinq-post-2',
		'post_date'   => '2026-02-28 10:00:00',
	),
	array(
		'title'       => 'Pourquoi nous ne livrons jamais de site sans cache',
		'slug'        => 'pourquoi-nous-ne-livrons-jamais-un-site-sans-cache',
		'excerpt'     => 'Un site WordPress sans stratégie de cache est un site qui ralentit dès la première campagne.',
		'category_id' => $category_ids['performance'],
		'seed'        => 'cinq-post-3',
		'post_date'   => '2026-02-14 10:00:00',
	),
	array(
		'title'       => 'RGPD et cookies : ce qu\'on met en place par défaut',
		'slug'        => 'rgpd-et-cookies-par-defaut',
		'excerpt'     => 'Consentement, registre, durées de conservation : le starter intègre les bases, le reste se câble au projet.',
		'category_id' => $category_ids['conformite'],
		'seed'        => 'cinq-post-4',
		'post_date'   => '2026-02-01 10:00:00',
	),
	array(
		'title'       => 'ACF ou Gutenberg : comment on tranche',
		'slug'        => 'acf-ou-gutenberg-comment-on-tranche',
		'excerpt'     => 'Les deux ont leur place. Voici la règle qu\'on applique sur chaque projet.',
		'category_id' => $category_ids['developpement'],
		'seed'        => 'cinq-post-5',
		'post_date'   => '2026-02-28 10:00:00',
	),
	array(
		'title'       => 'Core Web Vitals : ce qui compte vraiment en 2026',
		'slug'        => 'core-web-vitals-ce-qui-compte-vraiment-en-2026',
		'excerpt'     => 'INP a remplacé FID. Ce que ça change concrètement pour un site WordPress.',
		'category_id' => $category_ids['performance'],
		'seed'        => 'cinq-post-6',
		'post_date'   => '2026-02-14 10:00:00',
	),
	array(
		'title'       => 'Comment nous structurons un projet de refonte',
		'slug'        => 'comment-nous-structurons-un-projet-de-refonte',
		'excerpt'     => 'Audit, arborescence, contenus, développement : l\'ordre compte autant que la stack.',
		'category_id' => $category_ids['strategie'],
		'seed'        => 'cinq-post-7',
		'post_date'   => '2026-01-20 10:00:00',
	),
	array(
		'title'       => 'Pourquoi nous choisissons Tailwind plutôt que Bootstrap',
		'slug'        => 'pourquoi-tailwind-plutot-que-bootstrap',
		'excerpt'     => 'Utility-first, pas de surcharge CSS, tokens partagés avec Figma : Tailwind colle au workflow CINQ.',
		'category_id' => $category_ids['developpement'],
		'seed'        => 'cinq-post-8',
		'post_date'   => '2026-01-08 10:00:00',
	),
);

$post_ids = array();

foreach ( $demo_posts as $index => $post_data ) {
	$image_size = $post_data['image_size'] ?? '1200/800';

	$image_id = cinq_seed_import_remote_image(
		sprintf( 'https://picsum.photos/seed/%s/%s', $post_data['seed'], $image_size ),
		sprintf( 'Featured image %d', $index + 1 )
	);

	$created_post_id = cinq_seed_blog_post( $post_data, $image_id );

	if ( $created_post_id ) {
		$post_ids[ $post_data['slug'] ] = $created_post_id;
	}
}

if ( ! empty( $post_ids['pourquoi-nous-refusons-les-page-builders'] ) ) {
	$related_ids = array_values(
		array_filter(
			array(
				$post_ids['acf-ou-gutenberg-comment-on-tranche'] ?? 0,
				$post_ids['core-web-vitals-ce-qui-compte-vraiment-en-2026'] ?? 0,
				$post_ids['migrer-un-site-wordpress-sans-perdre-le-seo'] ?? 0,
			)
		)
	);

	if ( $related_ids ) {
		update_field(
			'related',
			$related_ids,
			(int) $post_ids['pourquoi-nous-refusons-les-page-builders']
		);
	}
}

WP_CLI::success(
	sprintf(
		'Posts archive seeded. Journal page ID %d. %d posts published. Featured single: %s',
		$journal_page_id,
		count( $post_ids ),
		get_permalink( $post_ids['pourquoi-nous-refusons-les-page-builders'] ?? $journal_page_id )
	)
);
