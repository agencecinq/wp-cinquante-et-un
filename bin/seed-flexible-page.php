<?php
/**
 * Seed the flexible page demo from Figma (node 3:104).
 *
 * Usage (Local site running):
 * wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-flexible-page.php \
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
 * Builds flexible page blocks from the Figma reference.
 *
 * @param int $media_image_id Media attachment ID.
 * @param int $form_id        Contact Form 7 post ID.
 * @return array<int, array<string, mixed>>
 */
function cinq_seed_flexible_page_blocks( int $media_image_id, int $form_id = 0 ): array {
	$layout     = cinq_seed_layout();
	$layout_cta = cinq_seed_layout( 'xl', 'xl', 'inverse' );

	$richtext_body = <<<'HTML'
<p>Elementor et Divi promettent l'autonomie et livrent de la dette. Le HTML généré est illisible, les performances s'effondrent, et le jour où vous voulez changer d'outil, le contenu ne suit pas.</p>
<h2>Ce que vous perdez vraiment</h2>
<p>Un site construit au page builder porte en moyenne trois fois plus de CSS que nécessaire. Sur mobile, c'est la différence entre un LCP à 1,8 s et un LCP à 4 s — donc entre une page qui convertit et une page qu'on quitte.</p>
<ul>
<li>Du poids : styles inline, dépendances, scripts jamais utilisés</li>
<li>De la portabilité : le contenu est prisonnier du format de l'outil</li>
<li>De l'auditabilité : votre équipe technique ne peut plus relire le code</li>
</ul>
<p>Avec ACF et Gutenberg, chaque bloc est un fichier PHP que vous pouvez ouvrir, lire et modifier. Le contenu reste dans la base, dans des champs nommés.</p>
HTML;

	return array(
		array(
			'acf_fc_layout' => 'rich_text',
			'layout'        => $layout,
			'content'       => array(
				'overline'        => 'Notre méthode',
				'title'           => 'Pourquoi nous refusons les page builders',
				'heading'         => 'h2',
				'text'            => $richtext_body,
				'text_alignment'  => 'text-left',
				'link'            => array(),
			),
		),
		array(
			'acf_fc_layout' => 'media_text',
			'layout'        => $layout,
			'media_position' => 'right',
			'media'         => cinq_seed_media( $media_image_id ),
			'content'       => array(
				'overline' => 'Performance',
				'title'    => 'Core Web Vitals dans le vert, dès la mise en ligne',
				'heading'  => 'h2',
				'text'     => 'Pas d’optimisation en rattrapage six mois après. Les budgets de performance sont posés au cadrage et vérifiés à chaque sprint : poids des images, chargement des polices, JavaScript différé.',
				'link'     => cinq_seed_link( 'Notre approche technique' ),
			),
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
			'acf_fc_layout' => 'form',
			'layout'        => cinq_seed_layout( 'md', 'md', 'default', 'contact' ),
			'content'       => array(
				'overline' => 'Contact',
				'title'    => 'Parlons de votre projet',
				'text'     => 'Décrivez votre besoin en quelques lignes. Nous répondons sous 48 h ouvrées, et le premier échange est toujours gratuit.',
			),
			'form'          => $form_id ?: null,
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

$page_slug  = 'creation-de-site-wordpress';
$page_title = 'Création de site WordPress';
$page_lead  = 'Thème custom, blocs ACF, zéro page builder. Un site que votre équipe édite au quotidien et que vos développeurs peuvent auditer.';

WP_CLI::log( 'Ensuring Contact Form 7 form…' );
$form_id = cinq_seed_get_or_create_cf7_form();

WP_CLI::log( 'Importing media placeholder…' );
$media_image_id = cinq_seed_import_remote_image( 'https://placehold.co/1200x900/jpg', 'Flexible page media' );

$existing_page = get_page_by_path( $page_slug );

if ( ! $existing_page ) {
	$page_id = wp_insert_post(
		array(
			'post_title'   => $page_title,
			'post_name'    => $page_slug,
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
	$page_id = (int) $existing_page->ID;
	wp_update_post(
		array(
			'ID'          => $page_id,
			'post_title'  => $page_title,
			'post_status' => 'publish',
		)
	);
}

update_field( 'page_lead', $page_lead, $page_id );
update_field( 'blocks', cinq_seed_flexible_page_blocks( $media_image_id, $form_id ), $page_id );

cinq_seed_add_page_to_main_menu( $page_id, 'Nos expertises' );

WP_CLI::success(
	sprintf(
		'Flexible page seeded (ID %d). URL: %s',
		$page_id,
		get_permalink( $page_id )
	)
);
