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
 * Builds the flexible content blocks for the home page.
 *
 * @param int   $hero_image_id    Hero / wide image attachment ID.
 * @param int   $media_image_id   Media + text image attachment ID.
 * @param int   $avatar_image_id  Testimonial avatar attachment ID.
 * @param int[] $logo_image_ids    Logo gallery attachment IDs.
 * @return array<int, array<string, mixed>>
 */
function cinq_seed_home_blocks(
	int $hero_image_id,
	int $media_image_id,
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
			'alignment'          => 'left',
			'height'             => 'standard',
			'show_media_overlay' => 1,
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
			'columns'  => 3,
			'overline' => 'Nos expertises',
			'title'    => 'Ce que nous faisons',
			'cards'    => array(
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
			'media'          => $media_image_id,
			'media_position' => 'left',
			'media_ratio'    => '4:3',
			'overline'       => 'Performance',
			'title'          => 'Core Web Vitals dans le vert, dès la mise en ligne',
			'content'        => '<p>Pas d’optimisation en rattrapage six mois après. Les budgets de performance sont posés au cadrage et vérifiés à chaque sprint : poids des images, chargement des polices, JavaScript différé.</p>',
			'cta'            => cinq_seed_link( 'Notre approche technique' ),
		),
		array(
			'acf_fc_layout' => 'key_figures',
			'layout'        => $layout,
			'overline'      => 'Résultats',
			'title'         => 'Ce que ça change, concrètement',
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
			'mode'          => 'auto',
			'columns'       => 3,
			'hide_if_empty' => 1,
			'count'         => 3,
			'overline'      => 'Réalisations',
			'title'         => 'Des projets qui tiennent dans le temps',
			'link'          => cinq_seed_link( 'Tous les cas clients', '#realisations' ),
		),
		array(
			'acf_fc_layout' => 'testimonials',
			'layout'        => $layout,
			'source'        => 'manual',
			'columns'       => 3,
			'overline'      => 'Retours clients',
			'title'         => 'Ce qu’ils en disent',
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
			'overline'      => 'Questions fréquentes',
			'title'         => 'Ce qu’on nous demande le plus',
			'items'         => array(
				array(
					'question' => 'Combien de temps prend une refonte ?',
					'answer'   => 'Entre huit et douze semaines pour un site vitrine d’une trentaine de pages, cadrage compris. Le facteur limitant n’est presque jamais le développement : c’est la production du contenu.',
				),
				array(
					'question' => 'Pouvez-vous reprendre un site existant ?',
					'answer'   => 'Oui. Nous auditons le thème, les extensions et le contenu, puis reconstruisons ce qui ne peut pas être maintenu. Les URLs et le SEO sont cartographiés avant toute mise en ligne.',
				),
				array(
					'question' => 'Que se passe-t-il après la mise en ligne ?',
					'answer'   => 'Vous éditez le contenu. Nous restons disponibles pour les mises à jour, les sauvegardes et le travail qui nécessite du code. La TMA correspond au SLA, pas à une facture surprise.',
				),
				array(
					'question' => 'Travaillez-vous avec des plugins tiers ?',
					'answer'   => 'ACF est la seule extension du noyau. Les adapters projet (formulaires, SEO, CRM) se câblent site par site, pas dans le starter.',
				),
				array(
					'question' => 'Le code nous appartient-il vraiment ?',
					'answer'   => 'Oui. Le thème vit dans votre dépôt Git dès le premier commit. Pas de page builder, pas de lock-in propriétaire.',
				),
			),
		),
		array(
			'acf_fc_layout' => 'cta',
			'layout'        => $layout_cta,
			'title'         => 'Un projet de site ou de refonte ?',
			'text'          => 'Un premier échange de trente minutes suffit à savoir si nous sommes le bon partenaire. Sans engagement, et sans présentation commerciale.',
			'cta_primary'   => cinq_seed_link( 'Prendre rendez-vous', '#contact' ),
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

WP_CLI::log( 'Importing placeholder images…' );

$hero_image_id   = cinq_seed_import_remote_image( 'https://placehold.co/1600x900/jpg', 'Hero placeholder' );
$media_image_id  = cinq_seed_import_remote_image( 'https://placehold.co/1200x900/jpg', 'Media placeholder' );
$avatar_image_id = cinq_seed_import_remote_image( 'https://placehold.co/80x80/jpg', 'Avatar placeholder' );

$logo_image_ids = array();
$logo_labels    = array( 'Nexiode', 'Laffargue', 'Beau Nuage', 'Zeta', 'Maison&B', 'Esprit BBQ' );

foreach ( $logo_labels as $index => $label ) {
	$logo_id = cinq_seed_import_remote_image(
		sprintf( 'https://placehold.co/150x32/jpg?text=%d', $index + 1 ),
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
	$avatar_image_id,
	$logo_image_ids
);

update_field( 'blocks', $blocks, $page_id );

WP_CLI::log( 'Seeding agency page…' );
cinq_seed_agence_page( $hero_image_id, $media_image_id, $avatar_image_id );

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
