<?php
/**
 * Seed the home page with Figma demo content (node 3:103).
 *
 * Usage (Local site running):
 * wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-home-page.php \
 *   --path=/path/to/wordpress/public
 *
 * @package WPCinquanteEtUn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'update_field' ) ) {
	WP_CLI::error( 'Advanced Custom Fields must be active.' );
}

require_once __DIR__ . '/seed-helpers.php';

/**
 * Upload a remote image to the media library.
 *
 * @param string $url   Image URL.
 * @param string $title Attachment title.
 * @return int Attachment ID or 0 on failure.
 */
function cinq_seed_sideload_image( string $url, string $title ): int {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$attachment_id = media_sideload_image( $url, 0, $title, 'id' );

	if ( is_wp_error( $attachment_id ) ) {
		WP_CLI::warning( sprintf( 'Could not sideload "%s": %s', $title, $attachment_id->get_error_message() ) );
		return 0;
	}

	return (int) $attachment_id;
}

/**
 * Builds the flexible content blocks for the home page.
 *
 * @param int   $hero_image_id       Hero / wide image attachment ID.
 * @param int   $media_image_id      Media + text image attachment ID.
 * @param int   $case_study_image_id Case study image attachment ID.
 * @param int   $avatar_image_id     Testimonial avatar attachment ID.
 * @param int[] $logo_image_ids    Logo gallery attachment IDs.
 * @return array<int, array<string, mixed>>
 */
function cinq_seed_home_blocks(
	int $hero_image_id,
	int $media_image_id,
	int $case_study_image_id,
	int $avatar_image_id,
	array $logo_image_ids
): array {
	$layout      = cinq_seed_layout();
	$layout_none = cinq_seed_layout( 'none', 'none' );
	$layout_cta  = cinq_seed_layout( 'xl', 'xl', 'inverse' );

	return array(
		array(
			'acf_fc_layout'      => 'hero',
			'layout'             => $layout_none,
			'show_media_overlay' => 0,
			'media'              => cinq_seed_media( $hero_image_id ),
			'content'            => array(
				'overline'       => 'Agence WordPress',
				'title'          => 'Des sites que votre équipe peut faire vivre',
				'heading'        => 'h1',
				'text'           => 'Thème custom, blocs ACF, zéro page builder. Vous éditez le contenu, on intervient quand le code doit bouger.',
				'link'           => cinq_seed_link( 'Parlons de votre projet', '#contact' ),
				'secondary_link' => cinq_seed_link( 'Voir nos réalisations', '#realisations' ),
			),
		),
		array(
			'acf_fc_layout' => 'logos',
			'layout'        => cinq_seed_layout( 'md', 'md' ),
			'title'         => 'Ils nous font confiance',
			'logos'         => $logo_image_ids,
			'grayscale'     => 1,
		),
		array(
			'acf_fc_layout' => 'cards_grid',
			'layout'        => $layout,
			'columns'       => 3,
			'content'       => array(
				'overline' => 'Nos expertises',
				'title'    => 'Ce que nous faisons',
			),
			'cards'         => array(
				array(
					'icon'  => null,
					'title' => 'Création de site',
					'text'  => 'Thème custom sur base Sage, blocs ACF sur mesure. Livré dans votre dépôt Git dès le premier commit.',
					'link'  => cinq_seed_link( 'Notre méthode' ),
				),
				array(
					'icon'  => null,
					'title' => 'Refonte',
					'text'  => 'Reprise page par page, structure repensée pour l’éditorial futur. Le contenu et le SEO sont conservés.',
					'link'  => cinq_seed_link( 'Notre méthode' ),
				),
				array(
					'icon'  => null,
					'title' => 'Maintenance',
					'text'  => 'Mises à jour, sauvegardes, surveillance et TMA. Le hotfix correctif relève d’un SLA selon le palier.',
					'link'  => cinq_seed_link( 'Notre méthode' ),
				),
			),
		),
		array(
			'acf_fc_layout'  => 'media_text',
			'layout'         => $layout,
			'media_position' => 'left',
			'media'          => cinq_seed_media( $media_image_id ),
			'content'        => array(
				'overline' => 'Performance',
				'title'    => 'Core Web Vitals dans le vert, dès la mise en ligne',
				'heading'  => 'h2',
				'text'     => 'Pas d’optimisation en rattrapage six mois après. Les budgets de performance sont posés au cadrage et vérifiés à chaque sprint : poids des images, chargement des polices, JavaScript différé.',
				'link'     => cinq_seed_link( 'Notre approche technique' ),
			),
		),
		array(
			'acf_fc_layout' => 'key_figures',
			'layout'        => $layout,
			'content'       => array(
				'overline' => 'Résultats',
				'title'    => 'Ce que ça change, concrètement',
			),
			'figures'       => array(
				array(
					'value'  => '+68',
					'suffix' => '%',
					'label'  => 'de demandes de devis en six mois',
				),
				array(
					'value'  => '1,4',
					'suffix' => 's',
					'label'  => 'de LCP médian sur mobile',
				),
				array(
					'value'  => '95',
					'suffix' => '+',
					'label'  => 'de score PageSpeed mobile',
				),
				array(
					'value'  => '0',
					'suffix' => '',
					'label'  => 'plugin de page builder',
				),
			),
		),
		array(
			'acf_fc_layout' => 'case_studies',
			'layout'        => $layout,
			'content'       => array(
				'overline' => 'Réalisations',
				'title'    => 'Des projets qui tiennent dans le temps',
				'link'     => cinq_seed_link( 'Tous les cas clients', '#realisations' ),
			),
			'items'         => array(
				array(
					'image'        => $case_study_image_id,
					'sector'       => 'Industrie',
					'client'       => 'Nexiode',
					'title'        => 'Refonte du site corporate et du configurateur',
					'url'          => '#',
					'result_value' => '+68 %',
					'result_label' => 'de demandes de devis',
				),
				array(
					'image'        => $case_study_image_id,
					'sector'       => 'Industrie',
					'client'       => 'Laffargue',
					'title'        => 'Plateforme éditoriale et espace revendeurs',
					'url'          => '#',
					'result_value' => '1,4 s',
					'result_label' => 'de LCP sur mobile',
				),
				array(
					'image'        => $case_study_image_id,
					'sector'       => 'Industrie',
					'client'       => 'Beau Nuage',
					'title'        => 'Migration WooCommerce vers Shopify',
					'url'          => '#',
					'result_value' => '×2,3',
					'result_label' => 'de taux de conversion',
				),
			),
		),
		array(
			'acf_fc_layout' => 'testimonials',
			'layout'        => $layout,
			'content'       => array(
				'overline' => 'Retours clients',
				'title'    => 'Ce qu’ils en disent',
			),
			'items'         => array(
				array(
					'quote'   => 'Ils ont refusé la solution facile et pris le temps de comprendre notre métier. Le back-office est enfin utilisable par l’équipe communication.',
					'author'  => 'Sophie Lemarchand',
					'role'    => 'Directrice communication',
					'company' => 'Nexiode',
					'avatar'  => $avatar_image_id,
				),
				array(
					'quote'   => 'Le site est passé de 4,2 s à 1,4 s de chargement. Nos demandes de devis ont suivi, sans qu’on touche au budget publicitaire.',
					'author'  => 'Marc Vandenberghe',
					'role'    => 'Directeur général',
					'company' => 'Laffargue',
					'avatar'  => $avatar_image_id,
				),
				array(
					'quote'   => 'Trois ans après la livraison, on édite toujours nous-mêmes. Aucune dépendance, aucune surprise à la facture.',
					'author'  => 'Inès Bakouche',
					'role'    => 'Responsable marketing',
					'company' => 'Zeta',
					'avatar'  => $avatar_image_id,
				),
			),
		),
		array(
			'acf_fc_layout' => 'accordion_group',
			'layout'        => $layout,
			'schema'        => 1,
			'content'       => array(
				'overline' => 'Questions fréquentes',
				'title'    => 'Ce qu’on nous demande le plus',
			),
			'accordions'    => array(
				array(
					'header'  => 'Combien de temps prend une refonte ?',
					'content' => 'Entre huit et douze semaines pour un site vitrine d’une trentaine de pages, cadrage compris. Le facteur limitant n’est presque jamais le développement : c’est la production du contenu.',
				),
				array(
					'header'  => 'Pouvez-vous reprendre un site existant ?',
					'content' => 'Oui. Nous auditons le thème, les extensions et le contenu, puis reconstruisons ce qui ne peut pas être maintenu. Les URLs et le SEO sont cartographiés avant toute mise en ligne.',
				),
				array(
					'header'  => 'Que se passe-t-il après la mise en ligne ?',
					'content' => 'Vous éditez le contenu. Nous restons disponibles pour les mises à jour, les sauvegardes et le travail qui nécessite du code. La TMA correspond au SLA, pas à une facture surprise.',
				),
				array(
					'header'  => 'Travaillez-vous avec des plugins tiers ?',
					'content' => 'ACF est la seule extension du noyau. Les adapters projet (formulaires, SEO, CRM) se câblent site par site, pas dans le starter.',
				),
				array(
					'header'  => 'Le code nous appartient-il vraiment ?',
					'content' => 'Oui. Le thème vit dans votre dépôt Git dès le premier commit. Pas de page builder, pas de lock-in propriétaire.',
				),
			),
		),
		array(
			'acf_fc_layout' => 'cta',
			'layout'        => $layout_cta,
			'content'       => array(
				'title'   => 'Un projet de site ou de refonte ?',
				'heading' => 'h2',
				'text'    => 'Un premier échange de trente minutes suffit à savoir si nous sommes le bon partenaire. Sans engagement, et sans présentation commerciale.',
				'link'    => cinq_seed_link( 'Prendre rendez-vous', '#contact' ),
			),
		),
	);
}

/**
 * Seeds theme options used by the header, footer and global CTA.
 *
 * @return void
 */
function cinq_seed_theme_options(): void {
	$existing = get_field( 'theme', 'option' );
	$theme    = is_array( $existing ) ? $existing : array();

	$search_url = cinq_seed_search_page_url();

	if ( $search_url ) {
		$theme['search_url'] = $search_url;
	}

	$theme['contact'] = array_merge(
		$theme['contact'] ?? array(),
		array(
			'link'      => cinq_seed_link( 'Parlons de votre projet', '#contact' ),
			'email'     => 'contact@agencecinq.com',
			'phone'     => '01 23 45 67 89',
			'locations' => 'Paris · Lille',
		)
	);

	$theme['footer'] = array_merge(
		$theme['footer'] ?? array(),
		array(
			'newsletter' => array(
				'title' => 'La lettre de CINQ',
				'text'  => 'Un article par mois sur le web, la performance et la conception. Pas de promo.',
				'form'  => null,
			),
		)
	);

	update_field( 'theme', $theme, 'option' );
}

WP_CLI::log( 'Sideloading placeholder images…' );

$hero_image_id       = cinq_seed_sideload_image( 'https://picsum.photos/seed/cinq-hero/1600/900', 'Hero placeholder' );
$media_image_id      = cinq_seed_sideload_image( 'https://picsum.photos/seed/cinq-media/1200/900', 'Media placeholder' );
$case_study_image_id = cinq_seed_sideload_image( 'https://picsum.photos/seed/cinq-case/840/630', 'Case study placeholder' );
$avatar_image_id     = cinq_seed_sideload_image( 'https://picsum.photos/seed/cinq-avatar/80/80', 'Avatar placeholder' );

$logo_image_ids = array();
$logo_labels    = array( 'Nexiode', 'Laffargue', 'Beau Nuage', 'Zeta', 'Maison&B', 'Esprit BBQ' );

foreach ( $logo_labels as $index => $label ) {
	$logo_id = cinq_seed_sideload_image(
		sprintf( 'https://picsum.photos/seed/cinq-logo-%d/150/32', $index + 1 ),
		sprintf( 'Logo %s', $label )
	);

	if ( $logo_id ) {
		$logo_image_ids[] = $logo_id;
	}
}

$home_page = get_page_by_path( 'accueil' );

if ( ! $home_page ) {
	$page_id = wp_insert_post(
		array(
			'post_title'   => 'Accueil',
			'post_name'    => 'accueil',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		),
		true
	);

	if ( is_wp_error( $page_id ) ) {
		WP_CLI::error( $page_id->get_error_message() );
	}
} else {
	$page_id = (int) $home_page->ID;
	wp_update_post(
		array(
			'ID'          => $page_id,
			'post_status' => 'publish',
		)
	);
}

$blocks = cinq_seed_home_blocks(
	$hero_image_id,
	$media_image_id,
	$case_study_image_id,
	$avatar_image_id,
	$logo_image_ids
);

update_field( 'blocks', $blocks, $page_id );

WP_CLI::log( 'Seeding legal mentions page…' );
$mentions_page_id = cinq_seed_mentions_legales_page();

cinq_seed_theme_options();
cinq_seed_main_menu();
cinq_seed_footer_menus( $mentions_page_id );
cinq_seed_social_links();

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_id );

WP_CLI::success(
	sprintf(
		'Home page seeded (ID %d). Front page set to “Accueil”. URL: %s',
		$page_id,
		get_permalink( $page_id )
	)
);
