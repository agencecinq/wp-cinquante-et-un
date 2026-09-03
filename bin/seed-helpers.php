<?php
/**
 * Shared helpers for WP-CLI seed scripts.
 *
 * @package WPCinquanteEtUn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns a link field value.
 *
 * @param string $title Link label.
 * @param string $url   Link URL.
 * @return array<string, string>
 */
function cinq_seed_link( string $title, string $url = '#' ): array {
	return array(
		'title'  => $title,
		'url'    => $url,
		'target' => '',
	);
}

/**
 * Returns block layout settings.
 *
 * @param string $spacing_top    Spacing top token.
 * @param string $spacing_bottom Spacing bottom token.
 * @param string $color_scheme   Color scheme token.
 * @return array<string, string>
 */
function cinq_seed_layout(
	string $spacing_top = 'md',
	string $spacing_bottom = 'md',
	string $color_scheme = 'default',
	string $anchor = '',
	string $container = 'default'
): array {
	return array(
		'color_scheme'   => $color_scheme,
		'spacing_top'    => $spacing_top,
		'spacing_bottom' => $spacing_bottom,
		'anchor'         => $anchor,
		'container'      => $container,
	);
}

/**
 * Returns a media clone field value.
 *
 * @param int $image_id Attachment ID.
 * @return array<string, mixed>
 */
function cinq_seed_media( int $image_id ): array {
	return array(
		'images' => array(
			0 => $image_id,
			1 => $image_id,
		),
		'video'  => array(
			'file'   => false,
			'poster' => false,
		),
	);
}

/**
 * Imports a local image file into the media library.
 *
 * @param string $path  Absolute file path.
 * @param string $title Attachment title.
 * @return int Attachment ID or 0 on failure.
 */
function cinq_seed_import_image( string $path, string $title ): int {
	if ( ! file_exists( $path ) ) {
		WP_CLI::warning( sprintf( 'Missing file: %s', $path ) );
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$file_array = array(
		'name'     => basename( $path ),
		'tmp_name' => $path,
	);

	$attachment_id = media_handle_sideload( $file_array, 0, $title );

	if ( is_wp_error( $attachment_id ) ) {
		WP_CLI::warning( $attachment_id->get_error_message() );
		return 0;
	}

	return (int) $attachment_id;
}

/**
 * Downloads a placeholder JPEG and imports it.
 *
 * @param string $url   Image URL.
 * @param string $title Attachment title.
 * @return int Attachment ID or 0 on failure.
 */
function cinq_seed_import_remote_image( string $url, string $title ): int {
	$tmp = download_url( $url );

	if ( is_wp_error( $tmp ) ) {
		WP_CLI::warning( $tmp->get_error_message() );
		return 0;
	}

	$attachment_id = cinq_seed_import_image( $tmp, $title );

	@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged

	return $attachment_id;
}

/**
 * Returns the CF7 contact form markup matching the starter Figma design.
 *
 * @return string
 */
function cinq_seed_cf7_contact_form_markup(): string {
	return <<<'HTML'
<div class="space-y-4">
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
<p class="m-0 flex flex-col gap-2">
<label class="text-xs font-medium">Prénom</label>
[text* first-name class:cinq-field autocomplete:given-name placeholder "Camille"]
</p>
<p class="m-0 flex flex-col gap-2">
<label class="text-xs font-medium">Nom</label>
[text* last-name class:cinq-field autocomplete:family-name placeholder "Roussel"]
</p>
</div>
<p class="m-0 flex flex-col gap-2">
<label class="text-xs font-medium">Adresse e-mail</label>
[email* your-email class:cinq-field autocomplete:email placeholder "vous@entreprise.com"]
</p>
<p class="m-0 flex flex-col gap-2">
<label class="text-xs font-medium">Société</label>
[text company class:cinq-field autocomplete:organization placeholder "Nom de votre société"]
</p>
<p class="m-0 flex flex-col gap-2">
<label class="text-xs font-medium">Votre besoin</label>
[select need class:cinq-field include_blank "Création de site" "Refonte" "Maintenance" "Autre"]
</p>
<p class="m-0 flex flex-col gap-2">
<label class="text-xs font-medium">Votre projet</label>
[textarea project class:cinq-field placeholder "Décrivez votre besoin en quelques lignes…"]
</p>
<p class="m-0 flex items-center gap-2 text-sm">
[acceptance privacy use_label_element] J'accepte la politique de confidentialité [/acceptance]
</p>
<p class="m-0">
[submit class:button class:button--primary "Envoyer"]
</p>
</div>
HTML;
}

/**
 * Creates or updates the demo Contact Form 7 form.
 *
 * @param string $title Form title.
 * @return int Form post ID or 0 on failure.
 */
function cinq_seed_get_or_create_cf7_form( string $title = 'Contact projet' ): int {
	if ( ! post_type_exists( 'wpcf7_contact_form' ) || ! class_exists( 'WPCF7_ContactForm' ) ) {
		WP_CLI::warning( 'Contact Form 7 is not active.' );
		return 0;
	}

	$form_slug = sanitize_title( $title );
	$existing  = get_page_by_path( $form_slug, OBJECT, 'wpcf7_contact_form' );

	$form_markup = cinq_seed_cf7_contact_form_markup();

	if ( $existing ) {
		$form_id = (int) $existing->ID;
		$form    = WPCF7_ContactForm::get_instance( $form_id );

		if ( $form ) {
			$properties         = $form->get_properties();
			$properties['form'] = $form_markup;
			$form->set_properties( $properties );
			$form->save();
		}

		return $form_id;
	}

	$template = WPCF7_ContactForm::get_template(
		array(
			'title' => $title,
		)
	);

	$properties         = $template->get_properties();
	$properties['form'] = $form_markup;

	$properties['mail']['subject'] = sprintf( '[%s] Nouveau message depuis le site', get_bloginfo( 'name' ) );
	$properties['mail']['body']    = "Prénom: [first-name]\nNom: [last-name]\nE-mail: [your-email]\nSociété: [company]\nBesoin: [need]\n\nProjet:\n[project]";

	$template->set_properties( $properties );
	$form_id = $template->save();

	if ( $form_id ) {
		wp_update_post(
			array(
				'ID'        => $form_id,
				'post_name' => $form_slug,
			)
		);
	}

	return (int) $form_id;
}

/**
 * Returns the blog archive URL when available.
 *
 * @return string
 */
function cinq_seed_posts_url(): string {
	$page_for_posts = (int) get_option( 'page_for_posts' );

	if ( $page_for_posts ) {
		$url = get_permalink( $page_for_posts );

		if ( is_string( $url ) && $url ) {
			return $url;
		}
	}

	$url = get_post_type_archive_link( 'post' );

	return is_string( $url ) && $url ? $url : '#';
}

/**
 * Creates or returns a navigation menu term ID.
 *
 * @param string $name Menu name.
 * @return int Menu term ID or 0 on failure.
 */
function cinq_seed_get_or_create_nav_menu( string $name ): int {
	$menu = wp_get_nav_menu_object( $name );

	if ( $menu ) {
		return (int) $menu->term_id;
	}

	$menu_id = wp_create_nav_menu( $name );

	if ( is_wp_error( $menu_id ) ) {
		WP_CLI::warning( $menu_id->get_error_message() );
		return 0;
	}

	return (int) $menu_id;
}

/**
 * Assigns a menu to a theme location.
 *
 * @param string $location Theme location slug.
 * @param int    $menu_id  Menu term ID.
 * @return void
 */
function cinq_seed_assign_menu_location( string $location, int $menu_id ): void {
	if ( ! $menu_id ) {
		return;
	}

	$menu_locations              = get_nav_menu_locations();
	$menu_locations[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $menu_locations );
}

/**
 * Removes all items from a navigation menu.
 *
 * @param int $menu_id Menu term ID.
 * @return void
 */
function cinq_seed_clear_nav_menu( int $menu_id ): void {
	$items = wp_get_nav_menu_items( $menu_id );

	if ( ! is_array( $items ) ) {
		return;
	}

	foreach ( $items as $item ) {
		wp_delete_post( (int) $item->ID, true );
	}
}

/**
 * Adds a custom link to a navigation menu.
 *
 * @param int    $menu_id   Menu term ID.
 * @param string $title     Link label.
 * @param string $url       Link URL.
 * @param int    $parent_id Parent menu item ID.
 * @return int Menu item ID or 0 on failure.
 */
function cinq_seed_add_custom_menu_item(
	int $menu_id,
	string $title,
	string $url = '#',
	int $parent_id = 0
): int {
	if ( ! $menu_id ) {
		return 0;
	}

	$item_id = wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'     => $title,
			'menu-item-url'       => $url,
			'menu-item-type'      => 'custom',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_id,
		)
	);

	if ( is_wp_error( $item_id ) ) {
		WP_CLI::warning( $item_id->get_error_message() );
		return 0;
	}

	return (int) $item_id;
}

/**
 * Adds a page to a navigation menu.
 *
 * @param int    $menu_id   Menu term ID.
 * @param int    $page_id   Page ID.
 * @param string $title     Optional menu label override.
 * @param int    $parent_id Parent menu item ID.
 * @return int Menu item ID or 0 on failure.
 */
function cinq_seed_add_page_to_nav_menu(
	int $menu_id,
	int $page_id,
	string $title = '',
	int $parent_id = 0
): int {
	if ( ! $menu_id || ! $page_id ) {
		return 0;
	}

	$items = wp_get_nav_menu_items( $menu_id );

	if ( is_array( $items ) ) {
		foreach ( $items as $item ) {
			if ( 'page' === $item->object && (int) $item->object_id === $page_id ) {
				return (int) $item->ID;
			}
		}
	}

	$item_id = wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'     => $title ? $title : get_the_title( $page_id ),
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_id,
		)
	);

	if ( is_wp_error( $item_id ) ) {
		WP_CLI::warning( $item_id->get_error_message() );
		return 0;
	}

	return (int) $item_id;
}

/**
 * Creates or replaces a navigation menu and its custom links.
 *
 * @param string                           $name  Menu name.
 * @param array<int, array<string, mixed>> $links Link definitions (`title`, optional `url` or `page_id`).
 * @return int Menu term ID or 0 on failure.
 */
function cinq_seed_sync_custom_nav_menu( string $name, array $links ): int {
	$menu_id = cinq_seed_get_or_create_nav_menu( $name );

	if ( ! $menu_id ) {
		return 0;
	}

	cinq_seed_clear_nav_menu( $menu_id );

	foreach ( $links as $link ) {
		if ( ! empty( $link['page_id'] ) ) {
			cinq_seed_add_page_to_nav_menu(
				$menu_id,
				(int) $link['page_id'],
				(string) ( $link['title'] ?? '' )
			);
			continue;
		}

		if ( empty( $link['title'] ) ) {
			continue;
		}

		cinq_seed_add_custom_menu_item(
			$menu_id,
			(string) $link['title'],
			(string) ( $link['url'] ?? '#' )
		);
	}

	return $menu_id;
}

/**
 * Creates or updates a content-only page (page header + native editor content).
 *
 * @param string $slug      Page slug.
 * @param string $title     Page title.
 * @param string $lead      Page lead shown in the page header.
 * @param string $html_body WYSIWYG body stored in post_content.
 * @return int Page ID or 0 on failure.
 */
function cinq_seed_content_page( string $slug, string $title, string $lead, string $html_body ): int {
	$existing_page = get_page_by_path( $slug );

	if ( ! $existing_page ) {
		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => $html_body,
			),
			true
		);

		if ( is_wp_error( $page_id ) ) {
			WP_CLI::warning( $page_id->get_error_message() );
			return 0;
		}
	} else {
		$page_id = (int) $existing_page->ID;

		wp_update_post(
			array(
				'ID'           => $page_id,
				'post_title'   => $title,
				'post_status'  => 'publish',
				'post_content' => $html_body,
			)
		);
	}

	update_field( 'page_lead', $lead, $page_id );
	update_field( 'blocks', array(), $page_id );

	return (int) $page_id;
}

/**
 * Seeds the legal mentions demo page.
 *
 * @return int Page ID or 0 on failure.
 */
function cinq_seed_mentions_legales_page(): int {
	$body = <<<'HTML'
<h2>Éditeur du site</h2>
<p><strong>CINQ</strong><br />
SAS au capital de 10 000 euros<br />
Siège social : 37000 Tours, France<br />
SIRET : 000 000 000 00000<br />
Directeur de la publication : CINQ</p>
<h2>Contact</h2>
<p>Courriel : <a href="mailto:contact@agencecinq.com">contact@agencecinq.com</a></p>
<h2>Hébergement</h2>
<p>Ce site de démonstration est hébergé localement dans le cadre du starter WordPress CINQ. Remplacez ce contenu par les informations de votre hébergeur avant mise en production.</p>
<h2>Propriété intellectuelle</h2>
<p>L’ensemble des éléments composant ce site (textes, graphismes, logos, icônes, images, code source) est protégé par le droit de la propriété intellectuelle. Toute reproduction, représentation ou diffusion, totale ou partielle, sans autorisation écrite préalable est interdite.</p>
HTML;

	return cinq_seed_content_page(
		'mentions-legales',
		'Mentions légales',
		'Informations légales relatives à l’édition et à l’hébergement du site.',
		$body
	);
}

/**
 * Seeds the main navigation menu from the Figma reference (node 32:3).
 *
 * @return void
 */
function cinq_seed_main_menu(): void {
	$menu_id = cinq_seed_get_or_create_nav_menu( __( 'Main Menu', 'wp-cinquante-et-un' ) );

	if ( ! $menu_id ) {
		return;
	}

	cinq_seed_clear_nav_menu( $menu_id );

	$expertises_id = cinq_seed_add_custom_menu_item( $menu_id, 'Nos expertises', '#' );

	foreach ( array( 'Création de site', 'Refonte', 'SEO', 'Maintenance' ) as $title ) {
		cinq_seed_add_custom_menu_item( $menu_id, $title, '#', $expertises_id );
	}

	cinq_seed_add_custom_menu_item( $menu_id, 'Réalisations', '#realisations' );
	cinq_seed_add_custom_menu_item( $menu_id, 'Journal', cinq_seed_posts_url() );
	cinq_seed_add_custom_menu_item( $menu_id, 'Agence', '#' );

	cinq_seed_assign_menu_location( 'main', $menu_id );
}

/**
 * Seeds footer and legal navigation menus from the Figma reference (node 29:178).
 *
 * @param int $mentions_page_id Optional legal mentions page ID for the legals menu.
 * @return void
 */
function cinq_seed_footer_menus( int $mentions_page_id = 0 ): void {
	$footer_1_id = cinq_seed_sync_custom_nav_menu(
		__( 'Expertises', 'wp-cinquante-et-un' ),
		array(
			array( 'title' => 'Création de site' ),
			array( 'title' => 'Refonte' ),
			array( 'title' => 'SEO' ),
			array( 'title' => 'Maintenance' ),
		)
	);

	$footer_2_id = cinq_seed_sync_custom_nav_menu(
		__( 'Agence', 'wp-cinquante-et-un' ),
		array(
			array( 'title' => 'Notre méthode' ),
			array( 'title' => 'Équipe' ),
			array(
				'title' => 'Réalisations',
				'url'   => '#realisations',
			),
			array(
				'title' => 'Journal',
				'url'   => cinq_seed_posts_url(),
			),
		)
	);

	$legals_links = array(
		array(
			'title' => 'Mentions légales',
		),
		array(
			'title' => 'Confidentialité',
		),
		array(
			'title' => 'Cookies',
		),
		array(
			'title' => 'Accessibilité',
		),
	);

	if ( $mentions_page_id ) {
		$legals_links[0]['page_id'] = $mentions_page_id;
	}

	$legals_id = cinq_seed_sync_custom_nav_menu(
		__( 'Legals', 'wp-cinquante-et-un' ),
		$legals_links
	);

	cinq_seed_assign_menu_location( 'footer_1', $footer_1_id );
	cinq_seed_assign_menu_location( 'footer_2', $footer_2_id );
	cinq_seed_assign_menu_location( 'legals', $legals_id );
}

/**
 * Seeds social network URLs for the footer.
 *
 * @return void
 */
function cinq_seed_social_links(): void {
	update_option(
		'socials',
		array(
			'facebook'  => '#',
			'instagram' => '#',
			'linkedin'  => '#',
			'x'         => '#',
			'vimeo'     => '',
			'youtube'   => '',
		)
	);
}

/**
 * Adds a page to the main navigation menu.
 *
 * @param int    $page_id   Page ID.
 * @param string $parent_title Optional parent menu item title.
 * @return void
 */
function cinq_seed_add_page_to_main_menu( int $page_id, string $parent_title = '' ): void {
	$menu_locations = get_nav_menu_locations();
	$menu_id        = $menu_locations['main'] ?? 0;

	if ( ! $menu_id ) {
		$menu_name = __( 'Main Menu', 'wp-cinquante-et-un' );
		$menu      = wp_get_nav_menu_object( $menu_name );

		if ( ! $menu ) {
			$menu_id = wp_create_nav_menu( $menu_name );
		} else {
			$menu_id = (int) $menu->term_id;
		}

		$menu_locations['main'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $menu_locations );
	}

	$parent_id = 0;

	if ( $parent_title ) {
		$items = wp_get_nav_menu_items( $menu_id );

		if ( is_array( $items ) ) {
			foreach ( $items as $item ) {
				if ( $parent_title === $item->title ) {
					$parent_id = (int) $item->ID;
					break;
				}
			}
		}
	}

	$existing_items = wp_get_nav_menu_items( $menu_id );

	if ( is_array( $existing_items ) ) {
		foreach ( $existing_items as $item ) {
			if ( 'page' === $item->object && (int) $item->object_id === $page_id ) {
				WP_CLI::log( sprintf( 'Page already in main menu (item %d).', $item->ID ) );
				return;
			}
		}
	}

	wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-title'     => get_the_title( $page_id ),
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_id,
		)
	);
}

/**
 * Creates or updates a category term.
 *
 * @param string $name Category name.
 * @param string $slug Category slug.
 * @return int Term ID.
 */
function cinq_seed_category( string $name, string $slug ): int {
	$existing = get_term_by( 'slug', $slug, 'category' );

	if ( $existing instanceof \WP_Term ) {
		return (int) $existing->term_id;
	}

	$result = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );

	if ( is_wp_error( $result ) ) {
		WP_CLI::warning( $result->get_error_message() );
		return 0;
	}

	return (int) $result['term_id'];
}

/**
 * Creates or updates a post tag term.
 *
 * @param string $name Tag name.
 * @param string $slug Tag slug.
 * @return int Term ID.
 */
function cinq_seed_post_tag( string $name, string $slug ): int {
	$existing = get_term_by( 'slug', $slug, 'post_tag' );

	if ( $existing instanceof \WP_Term ) {
		return (int) $existing->term_id;
	}

	$result = wp_insert_term( $name, 'post_tag', array( 'slug' => $slug ) );

	if ( is_wp_error( $result ) ) {
		WP_CLI::warning( $result->get_error_message() );
		return 0;
	}

	return (int) $result['term_id'];
}

/**
 * Creates or updates the demo post author from the Figma single reference.
 *
 * @return int User ID.
 */
function cinq_seed_get_or_create_author(): int {
	$login    = 'thomas-aubert';
	$existing = get_user_by( 'login', $login );

	if ( $existing instanceof \WP_User ) {
		$user_id = (int) $existing->ID;
	} else {
		$user_id = wp_create_user( $login, wp_generate_password( 24, true, true ), 'thomas.aubert@agencecinq.com' );

		if ( is_wp_error( $user_id ) ) {
			WP_CLI::warning( $user_id->get_error_message() );
			return 0;
		}

		$user_id = (int) $user_id;
	}

	wp_update_user(
		array(
			'ID'           => $user_id,
			'display_name' => 'Thomas Aubert · Lead développeur',
			'first_name'   => 'Thomas',
			'last_name'    => 'Aubert',
			'description'  => 'Développe des thèmes WordPress sur mesure depuis douze ans. A vu passer assez de page builders pour avoir un avis tranché.',
		)
	);

	$avatar_id = cinq_seed_import_remote_image(
		'https://picsum.photos/seed/cinq-author-thomas/112/112',
		'Thomas Aubert avatar'
	);

	if ( $avatar_id ) {
		update_user_meta( $user_id, 'cinq_avatar_id', $avatar_id );
	}

	return $user_id;
}

/**
 * Returns the featured single-post body from the Figma reference (node 29:2).
 *
 * @return string
 */
function cinq_seed_page_builders_post_content(): string {
	return <<<'HTML'
<h2>Ce que promet un page builder</h2>
<p>L'argument est toujours le même&nbsp;: vous n'aurez plus besoin de développeur. En pratique, vous en aurez besoin exactement autant, mais pour des raisons moins intéressantes — réparer une mise en page cassée par une mise à jour plutôt que construire une fonctionnalité.</p>
<p>Le premier mois est agréable. On glisse des blocs, on voit le résultat. Puis la page d'accueil atteint quatre-vingts sections imbriquées et plus personne n'ose y toucher.</p>
<h2>Ce que vous perdez vraiment</h2>
<p>Un site construit au page builder porte en moyenne trois fois plus de CSS que nécessaire. Sur mobile, c'est la différence entre un LCP à 1,8&nbsp;s et un LCP à 4&nbsp;s — donc entre une page qui convertit et une page qu'on quitte.</p>
<blockquote><p>Le vrai coût d'un page builder n'apparaît pas à la livraison. Il apparaît à la deuxième refonte, quand il faut extraire le contenu.</p></blockquote>
<p>Avec ACF et Gutenberg, chaque bloc est un fichier PHP que vous pouvez ouvrir, lire et modifier. Le contenu reste dans la base de données, dans des champs nommés, exportable.</p>
<h2>La façon dont nous procédons</h2>
<p>Sur un projet CINQ, le contenu éditorial passe par des blocs ACF typés&nbsp;: hero, média + texte, chiffres clés, FAQ. Chaque layout a son Twig, ses tokens, ses contraintes de spacing. L'équipe éditoriale compose dans l'admin sans toucher au markup.</p>
<p>Les développeurs gardent la main sur la structure HTML, le schema.org, les performances et l'accessibilité. Quand le design évolue, on met à jour un composant une fois — pas quatre-vingts sections dans l'interface d'un plugin.</p>
<h2>Quand un page builder se justifie</h2>
<p>Nous refusons les page builders par défaut, pas dogmatiquement. Un landing ponctuel, une campagne isolée, un site interne à courte durée de vie&nbsp;: la vélocité peut primer sur la maintenabilité long terme.</p>
<p>Dès qu'un site doit durer, se faire référencer, accueillir du trafic payant ou évoluer avec la marque, nous recommandons une stack maîtrisée. C'est le cas de la plupart de nos clients — et la raison pour laquelle nous documentons nos arbitrages ici.</p>
HTML;
}

/**
 * Returns a short body for secondary demo posts.
 *
 * @param string $title   Post title.
 * @param string $excerpt Post excerpt.
 * @return string
 */
function cinq_seed_short_post_content( string $title, string $excerpt ): string {
	$paragraph = sprintf(
		'<p>%s</p>',
		esc_html( $excerpt )
	);

	$section_title = preg_replace( '/^(Pourquoi nous|Comment nous|Pourquoi)/u', '', $title );
	$section_title = trim( (string) $section_title );

	if ( '' === $section_title ) {
		$section_title = 'En pratique';
	}

	return sprintf(
		'%s<h2>%s</h2><p>%s</p>',
		$paragraph,
		esc_html( $section_title ),
		esc_html(
			'Cet article fait partie du contenu de démonstration du starter CINQ. Il illustre le gabarit single avec sommaire, tags et articles associés.'
		)
	);
}

/**
 * Creates or updates a demo blog post.
 *
 * @param array<string, mixed> $post_data Post definition.
 * @param int                  $image_id  Featured image attachment ID.
 * @return int Post ID.
 */
function cinq_seed_blog_post( array $post_data, int $image_id ): int {
	$existing = get_page_by_path( $post_data['slug'], OBJECT, 'post' );

	$content = $post_data['content'] ?? cinq_seed_short_post_content(
		(string) $post_data['title'],
		(string) $post_data['excerpt']
	);

	$postarr = array(
		'post_title'   => $post_data['title'],
		'post_name'    => $post_data['slug'],
		'post_status'  => 'publish',
		'post_type'    => 'post',
		'post_content' => $content,
		'post_excerpt' => $post_data['excerpt'],
	);

	if ( ! empty( $post_data['post_date'] ) ) {
		$postarr['post_date']     = $post_data['post_date'];
		$postarr['post_date_gmt'] = get_gmt_from_date( $post_data['post_date'] );
	}

	if ( ! empty( $post_data['author_id'] ) ) {
		$postarr['post_author'] = (int) $post_data['author_id'];
	}

	if ( $existing ) {
		$postarr['ID'] = (int) $existing->ID;
		$post_id       = wp_update_post( $postarr, true );
	} else {
		$post_id = wp_insert_post( $postarr, true );
	}

	if ( is_wp_error( $post_id ) ) {
		WP_CLI::warning( $post_id->get_error_message() );
		return 0;
	}

	$post_id = (int) $post_id;

	if ( $image_id ) {
		set_post_thumbnail( $post_id, $image_id );
	}

	if ( ! empty( $post_data['category_id'] ) ) {
		wp_set_post_terms( $post_id, array( (int) $post_data['category_id'] ), 'category', false );
	}

	if ( ! empty( $post_data['tag_ids'] ) && is_array( $post_data['tag_ids'] ) ) {
		wp_set_post_terms( $post_id, array_map( 'absint', $post_data['tag_ids'] ), 'post_tag', false );
	}

	$reading_time = isset( $post_data['reading_time'] )
		? (int) $post_data['reading_time']
		: cinq_estimate_reading_time( $content );

	if ( $reading_time > 0 ) {
		update_field( 'reading_time', $reading_time, $post_id );
	}

	if ( ! empty( $post_data['related_ids'] ) && is_array( $post_data['related_ids'] ) ) {
		update_field( 'related', array_map( 'absint', $post_data['related_ids'] ), $post_id );
	}

	return $post_id;
}

/**
 * Creates or updates the search landing page and returns its permalink.
 *
 * @return string Search page URL or empty string on failure.
 */
function cinq_seed_search_page_url(): string {
	$existing = get_page_by_path( 'recherche' );

	if ( $existing ) {
		$page_id = (int) $existing->ID;
	} else {
		$page_id = wp_insert_post(
			array(
				'post_title'  => 'Recherche',
				'post_name'   => 'recherche',
				'post_status' => 'publish',
				'post_type'   => 'page',
			),
			true
		);

		if ( is_wp_error( $page_id ) ) {
			WP_CLI::warning( $page_id->get_error_message() );
			return '';
		}

		$page_id = (int) $page_id;
	}

	update_post_meta( $page_id, '_wp_page_template', 'page-templates/search-page.php' );

	$url = get_permalink( $page_id );

	return is_string( $url ) ? $url : '';
}
