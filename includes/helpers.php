<?php
/**
 * WordPress helpers function
 *
 * Helpers are auto-loaded via composer.json "files" directive.
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

/**
 * Retrieve the classes for the html element as an array.
 *
 * @param  string|array $c One or more classes to add to the class list.
 * @return array Array of classes.
 * @access public
 */
function get_html_class( $c = '' ): array {
	$classes = array();

	if ( ! empty( $c ) ) {
		if ( ! is_array( $c ) ) {
			$c = preg_split( '#\s+#', $c );
		}
		$classes = array_merge( $classes, $c );
	} else {
		// Ensure that we always coerce class to being an array.
		$c = array();
	}
	$classes = array_map( 'esc_attr', $classes );
	/**
	 * Filter the list of CSS html classes for the current post or page.
	 *
	 * @param array  $classes An array of html classes.
	 * @param string $c   A comma-separated list of additional classes added to the html.
	 */
	$classes = apply_filters( 'html_class', $classes, $c );

	return array_unique( $classes );
}


/**
 * Display the classes for the html element.
 *
 * @param string|array $c One or more classes to add to the class list.
 * @return string
 */
function html_class( string $c = '' ): string {
	// Separates classes with a single space, collates classes for html element.
	return 'class="' . join( ' ', get_html_class( $c ) ) . '"';
}


/**
 * Allowed ACF section spacing steps (desktop / mobile).
 *
 * @return array<int, string>
 */
function cinq_section_spacing_steps(): array {
	return array( 'none', 'sm', 'md', 'lg', 'xl' );
}


/**
 * Sanitize a section spacing step.
 *
 * @param mixed $value Raw ACF value.
 * @return string
 */
function cinq_sanitize_section_spacing( $value ): string {
	$step = is_string( $value ) ? $value : '';

	return in_array( $step, cinq_section_spacing_steps(), true ) ? $step : 'none';
}


/**
 * Allowed block container width modes.
 *
 * @return array<int, string>
 */
function cinq_block_container_modes(): array {
	return array( 'default', 'wide', 'full' );
}


/**
 * Sanitize a block container mode.
 *
 * @param mixed $value Raw ACF value.
 * @return string
 */
function cinq_sanitize_block_container( $value ): string {
	$mode = is_string( $value ) ? $value : '';

	return in_array( $mode, cinq_block_container_modes(), true ) ? $mode : 'default';
}


/**
 * Container utility classes for a block layout group.
 *
 * @param mixed $layout ACF layout array.
 * @return string Space-separated classes, empty when full width.
 */
function cinq_block_container_classes( $layout = array() ): string {
	if ( ! is_array( $layout ) ) {
		$layout = array();
	}

	$mode = cinq_sanitize_block_container( $layout['container'] ?? 'default' );

	if ( 'wide' === $mode ) {
		return 'container-wide';
	}

	if ( 'full' === $mode ) {
		return '';
	}

	return 'container';
}


/**
 * Section anchor slug from a block layout group.
 *
 * @param mixed $layout ACF layout array.
 * @return string Sanitized slug, empty when unset.
 */
function cinq_block_anchor( $layout = array() ): string {
	if ( ! is_array( $layout ) ) {
		return '';
	}

	$anchor = isset( $layout['anchor'] ) ? (string) $layout['anchor'] : '';

	return '' !== $anchor ? sanitize_title( $anchor ) : '';
}


/**
 * Layout classes from a block layout group (color scheme + section spacing).
 *
 * @param mixed $layout ACF layout array.
 * @return string
 */
function cinq_block_layout_classes( $layout = array() ): string {
	if ( ! is_array( $layout ) ) {
		$layout = array();
	}

	$top    = cinq_sanitize_section_spacing( $layout['spacing_top'] ?? 'none' );
	$bottom = cinq_sanitize_section_spacing( $layout['spacing_bottom'] ?? 'none' );

	return implode(
		' ',
		array(
			'bg-background',
			'text-foreground',
			'pt-section-' . $top,
			'pb-section-' . $bottom,
		)
	);
}


/**
 * Color scheme slug for data-color-scheme.
 *
 * @param mixed $layout ACF layout array.
 * @return string
 */
function cinq_block_color_scheme( $layout = array() ): string {
	if ( ! is_array( $layout ) ) {
		return 'default';
	}

	return ( isset( $layout['color_scheme'] ) && 'inverse' === $layout['color_scheme'] ) ? 'inverse' : 'default';
}


/**
 * Estimate reading time in minutes from HTML or plain text.
 *
 * @param string $content Post content.
 * @return int At least 1 when the content is not empty, 0 otherwise.
 */
function cinq_estimate_reading_time( string $content ): int {
	$text = trim( wp_strip_all_tags( $content ) );

	if ( '' === $text ) {
		return 0;
	}

	$words = preg_match_all( '/[\p{L}\p{N}\'-]+/u', $text, $matches );

	if ( ! $words ) {
		return 1;
	}

	return max( 1, (int) ceil( $words / 200 ) );
}


/**
 * Add unique id attributes to H2 headings that do not already have one.
 *
 * @param string $content HTML content.
 * @return string
 */
function cinq_add_heading_ids( string $content ): string {
	if ( '' === $content || false === stripos( $content, '<h2' ) ) {
		return $content;
	}

	$used = array();

	return (string) preg_replace_callback(
		'/<h2([^>]*)>(.*?)<\/h2>/is',
		function ( $matches ) use ( &$used ) {
			$attrs = $matches[1];
			$inner = $matches[2];

			if ( preg_match( '/\bid\s*=/i', $attrs ) ) {
				return $matches[0];
			}

			$slug = sanitize_title( wp_strip_all_tags( $inner ) );

			if ( '' === $slug ) {
				return $matches[0];
			}

			$base = $slug;
			$i    = 2;

			while ( in_array( $slug, $used, true ) ) {
				$slug = $base . '-' . $i;
				++$i;
			}

			$used[] = $slug;

			return '<h2' . $attrs . ' id="' . esc_attr( $slug ) . '">' . $inner . '</h2>';
		},
		$content
	);
}


/**
 * Extract H2 table-of-contents entries from HTML content.
 *
 * Expects heading ids from cinq_add_heading_ids() or the editor.
 *
 * @param string $content HTML content.
 * @return array<int, array{title: string, id: string}>
 */
function cinq_parse_toc_items( string $content ): array {
	if ( '' === $content || false === stripos( $content, '<h2' ) ) {
		return array();
	}

	$items = array();

	if ( ! preg_match_all( '/<h2([^>]*)>(.*?)<\/h2>/is', $content, $matches, PREG_SET_ORDER ) ) {
		return array();
	}

	foreach ( $matches as $match ) {
		$attrs = $match[1];
		$inner = $match[2];
		$title = trim( wp_strip_all_tags( $inner ) );

		if ( '' === $title ) {
			continue;
		}

		if ( ! preg_match( '/\bid=["\']([^"\']+)["\']/i', $attrs, $id_match ) ) {
			continue;
		}

		$items[] = array(
			'title' => $title,
			'id'    => $id_match[1],
		);
	}

	return $items;
}


/**
 * Enrich a flexible content block with computed layout and schema values.
 *
 * @param array<string, mixed> $block ACF layout row.
 * @return void
 */
function cinq_enrich_block( array &$block ): void {
	if ( ! isset( $block['layout'] ) || ! is_array( $block['layout'] ) ) {
		$block['layout'] = array();
	}

	$block['layout']['color_scheme']      = cinq_block_color_scheme( $block['layout'] );
	$block['layout']['classes']           = cinq_block_layout_classes( $block['layout'] );
	$block['layout']['container_classes'] = cinq_block_container_classes( $block['layout'] );

	$anchor = cinq_block_anchor( $block['layout'] );

	if ( '' !== $anchor ) {
		$block['id'] = $anchor;
	} elseif ( ! isset( $block['id'] ) ) {
		$block['id'] = '';
	}

	if (
		isset( $block['acf_fc_layout'] )
		&& 'accordion_group' === $block['acf_fc_layout']
		&& ! empty( $block['schema'] )
		&& ! empty( $block['items'] )
		&& is_array( $block['items'] )
	) {
		$faq_schema = cinq_faq_schema_json( $block['items'] );

		if ( '' !== $faq_schema ) {
			$block['faq_schema_json'] = $faq_schema;
		}
	}

	if ( isset( $block['acf_fc_layout'] ) && 'testimonials' === $block['acf_fc_layout'] ) {
		$block['items'] = cinq_testimonial_block_items( $block );
	}

	if ( isset( $block['acf_fc_layout'] ) && 'team' === $block['acf_fc_layout'] ) {
		$block['members'] = cinq_team_block_members( $block );
	}

	if ( isset( $block['acf_fc_layout'] ) && 'case_studies' === $block['acf_fc_layout'] ) {
		if ( empty( $block['items'] ) || ! is_array( $block['items'] ) ) {
			$block['items'] = cinq_case_study_block_items( $block );
		}
	}

	if ( isset( $block['acf_fc_layout'] ) && 'latest_posts' === $block['acf_fc_layout'] ) {
		if ( empty( $block['posts'] ) ) {
			$block['posts'] = cinq_latest_posts_block_posts( $block );
		}
	}

	if (
		isset( $block['acf_fc_layout'] )
		&& 'contact' === $block['acf_fc_layout']
		&& ! empty( $block['schema'] )
	) {
		$local_business_schema = cinq_local_business_schema_json( $block );

		if ( '' !== $local_business_schema ) {
			$block['local_business_schema_json'] = $local_business_schema;
		}
	}
}


/**
 * FAQPage JSON-LD from accordion items.
 *
 * @param array<int, array<string, mixed>> $items Accordion repeater rows.
 * @return string Empty when there is nothing to output.
 */
function cinq_faq_schema_json( array $items ): string {
	$entities = array();

	foreach ( $items as $item ) {
		$question = isset( $item['question'] ) ? wp_strip_all_tags( (string) $item['question'] ) : '';
		$answer   = isset( $item['answer'] ) ? wp_strip_all_tags( (string) $item['answer'] ) : '';

		if ( '' === $question || '' === $answer ) {
			continue;
		}

		$entities[] = array(
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $answer,
			),
		);
	}

	if ( empty( $entities ) ) {
		return '';
	}

	return (string) wp_json_encode(
		array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $entities,
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);
}

/**
 * Contact Form 7 forms for ACF form_id select fields.
 *
 * @return array<string, string> Form ID => title.
 */
function cinq_cf7_form_choices(): array {
	if ( ! post_type_exists( 'wpcf7_contact_form' ) ) {
		return array();
	}

	$forms = get_posts(
		array(
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	if ( empty( $forms ) ) {
		return array();
	}

	$choices = array();

	foreach ( $forms as $form ) {
		$choices[ (string) $form->ID ] = $form->post_title;
	}

	return $choices;
}

/**
 * LocalBusiness JSON-LD from a contact block row.
 *
 * @param array<string, mixed> $block ACF layout row.
 * @return string Empty when there is nothing to output.
 */
function cinq_local_business_schema_json( array $block ): string {
	$has_contact_data = ! empty( $block['address'] )
		|| ! empty( $block['phone'] )
		|| ! empty( $block['email'] )
		|| ( ! empty( $block['hours'] ) && is_array( $block['hours'] ) )
		|| ! empty( $block['map_image'] )
		|| ! empty( $block['map_link'] );

	if ( ! $has_contact_data ) {
		return '';
	}

	$entity = array(
		'@context' => 'https://schema.org',
		'@type'    => 'LocalBusiness',
		'name'     => get_bloginfo( 'name' ),
	);

	if ( ! empty( $block['address'] ) ) {
		$entity['address'] = array(
			'@type'         => 'PostalAddress',
			'streetAddress' => wp_strip_all_tags( (string) $block['address'] ),
		);
	}

	if ( ! empty( $block['phone'] ) ) {
		$entity['telephone'] = preg_replace( '/\s+/', '', (string) $block['phone'] );
	}

	if ( ! empty( $block['email'] ) ) {
		$entity['email'] = sanitize_email( (string) $block['email'] );
	}

	if ( ! empty( $block['hours'] ) && is_array( $block['hours'] ) ) {
		$specifications = array();

		foreach ( $block['hours'] as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}

			$days  = isset( $row['days'] ) ? wp_strip_all_tags( (string) $row['days'] ) : '';
			$hours = isset( $row['hours'] ) ? wp_strip_all_tags( (string) $row['hours'] ) : '';

			if ( '' === $days && '' === $hours ) {
				continue;
			}

			$specification = array(
				'@type' => 'OpeningHoursSpecification',
			);

			if ( '' !== $days ) {
				$specification['dayOfWeek'] = $days;
			}

			if ( '' !== $hours ) {
				$specification['description'] = $hours;
			}

			$specifications[] = $specification;
		}

		if ( ! empty( $specifications ) ) {
			$entity['openingHoursSpecification'] = $specifications;
		}
	}

	if ( ! empty( $block['map_image'] ) ) {
		$image_url = wp_get_attachment_image_url( (int) $block['map_image'], 'large' );

		if ( is_string( $image_url ) && '' !== $image_url ) {
			$entity['image'] = $image_url;
		}
	}

	if ( ! empty( $block['map_link'] ) ) {
		$entity['hasMap'] = esc_url_raw( (string) $block['map_link'] );
	}

	return (string) wp_json_encode(
		$entity,
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);
}

/**
 * Resolve a case study URL for a logo attachment when link_logos is enabled.
 *
 * Projects wire filename matching (or CPT lookup) via the cinq_logos_case_study_url filter.
 *
 * @param int|array<string, mixed>|object $logo Attachment ID or image value.
 * @return string Empty when no link should be rendered.
 */
function cinq_logos_case_study_url( $logo ): string {
	$url = apply_filters( 'cinq_logos_case_study_url', '', $logo );

	return is_string( $url ) ? $url : '';
}

/**
 * Resolve testimonial rows for the testimonials block.
 *
 * @param array<string, mixed> $block ACF layout row.
 * @return array<int, array<string, mixed>>
 */
function cinq_testimonial_block_items( array $block ): array {
	$source = $block['source'] ?? 'manual';

	if ( 'cpt' === $source && ! empty( $block['selection'] ) && is_array( $block['selection'] ) ) {
		$items = apply_filters( 'cinq_testimonials_from_selection', array(), $block['selection'], $block );

		return is_array( $items ) ? $items : array();
	}

	if ( ! empty( $block['items'] ) && is_array( $block['items'] ) ) {
		return $block['items'];
	}

	return array();
}

/**
 * Normalize one testimonial row from a manual repeater or CPT post.
 *
 * @param array<string, mixed>|object $item Repeater row or post object.
 * @return array<string, mixed>
 */
function cinq_normalize_testimonial_item( $item ): array {
	if ( is_array( $item ) && isset( $item['quote'] ) ) {
		return $item;
	}

	if ( is_object( $item ) && method_exists( $item, 'meta' ) ) {
		$avatar = $item->meta( 'avatar' );

		return array(
			'quote'   => (string) $item->meta( 'quote' ),
			'author'  => $item->title(),
			'role'    => (string) $item->meta( 'role' ),
			'company' => (string) $item->meta( 'company' ),
			'avatar'  => $avatar ? $avatar : $item->thumbnail(),
		);
	}

	return array();
}

/**
 * Resolve member rows for the team block.
 *
 * @param array<string, mixed> $block ACF layout row.
 * @return array<int, array<string, mixed>>
 */
function cinq_team_block_members( array $block ): array {
	if ( ! empty( $block['members'] ) && is_array( $block['members'] ) ) {
		$members = array_map( 'cinq_normalize_team_member', $block['members'] );

		return array_values( array_filter( $members ) );
	}

	$members = apply_filters( 'cinq_team_members', array(), $block );

	return is_array( $members ) ? array_values( array_filter( array_map( 'cinq_normalize_team_member', $members ) ) ) : array();
}

/**
 * Normalize one team member from a styleguide fixture or CPT post.
 *
 * @param array<string, mixed>|object $member Fixture row or post object.
 * @return array<string, mixed>
 */
function cinq_normalize_team_member( $member ): array {
	if ( is_array( $member ) && isset( $member['name'] ) ) {
		return $member;
	}

	if ( is_object( $member ) && method_exists( $member, 'meta' ) ) {
		$socials = $member->meta( 'socials' );

		return array(
			'name'    => $member->title(),
			'role'    => (string) $member->meta( 'role' ),
			'bio'     => (string) $member->meta( 'bio' ),
			'photo'   => $member->thumbnail(),
			'socials' => is_array( $socials ) ? $socials : array(),
		);
	}

	return array();
}

/**
 * Resolve case study cards for the case_studies block.
 *
 * @param array<string, mixed> $block ACF layout row.
 * @return array<int, array<string, mixed>>
 */
function cinq_case_study_block_items( array $block ): array {
	$mode = $block['mode'] ?? 'auto';

	if ( ! empty( $block['items'] ) && is_array( $block['items'] ) ) {
		$first = reset( $block['items'] );

		if ( is_array( $first ) && ( isset( $first['image'] ) || isset( $first['client'] ) ) ) {
			return $block['items'];
		}
	}

	if ( 'manual' === $mode && ! empty( $block['selection'] ) && is_array( $block['selection'] ) ) {
		$items = apply_filters( 'cinq_case_studies_from_selection', array(), $block['selection'], $block );
		$items = is_array( $items ) ? $items : array();

		return array_values( array_filter( array_map( 'cinq_normalize_case_study_item', $items ) ) );
	}

	if ( 'auto' === $mode && post_type_exists( 'case_study' ) ) {
		$count = max( 1, min( 6, (int) ( $block['count'] ?? 3 ) ) );
		$query = array(
			'post_type'      => 'case_study',
			'posts_per_page' => $count,
			'post_status'    => 'publish',
		);

		if ( ! empty( $block['sector'] ) ) {
			$term_id = is_array( $block['sector'] ) ? (int) ( $block['sector'][0] ?? 0 ) : (int) $block['sector'];

			if ( $term_id > 0 ) {
				$query['tax_query'] = array(
					array(
						'taxonomy' => 'sector',
						'field'    => 'term_id',
						'terms'    => $term_id,
					),
				);
			}
		}

		$posts = \Timber\Timber::get_posts( $query );

		if ( $posts ) {
			return array_values(
				array_filter(
					array_map( 'cinq_normalize_case_study_item', iterator_to_array( $posts, false ) )
				)
			);
		}
	}

	$items = apply_filters( 'cinq_case_study_block_items', array(), $block );

	return is_array( $items ) ? $items : array();
}

/**
 * Normalize one case study card from a fixture row or CPT post.
 *
 * @param array<string, mixed>|object $item Fixture row or post object.
 * @return array<string, mixed>
 */
function cinq_normalize_case_study_item( $item ): array {
	if ( is_array( $item ) && isset( $item['title'] ) ) {
		return $item;
	}

	if ( is_object( $item ) && method_exists( $item, 'meta' ) ) {
		$result_value = '';
		$result_label = '';
		$results      = $item->meta( 'results' );

		if ( is_array( $results ) && ! empty( $results[0] ) && is_array( $results[0] ) ) {
			$result_value = (string) ( $results[0]['value'] ?? '' );
			$result_label = (string) ( $results[0]['label'] ?? '' );
		}

		$sector = '';

		if ( method_exists( $item, 'terms' ) ) {
			$terms = $item->terms( 'sector' );

			if ( ! empty( $terms ) && is_array( $terms ) ) {
				$sector = (string) ( $terms[0]->name ?? '' );
			}
		}

		return array(
			'image'        => $item->thumbnail(),
			'sector'       => $sector,
			'client'       => (string) $item->meta( 'client' ),
			'title'        => $item->title(),
			'url'          => $item->link(),
			'result_value' => $result_value,
			'result_label' => $result_label,
		);
	}

	return array();
}

/**
 * Starter demo cards when the case_study CPT is not registered yet.
 *
 * @return array<int, array<string, mixed>>
 */
function cinq_starter_demo_case_study_cards(): array {
	$image = \WPCinquanteEtUn\Models\Styleguide\StyleguideContext::placeholder_image( 1600, 1200 );

	return array(
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
	);
}

/**
 * Resolve posts for the latest_posts block.
 *
 * @param array<string, mixed> $block ACF layout row.
 * @return array<int, object>
 */
function cinq_latest_posts_block_posts( array $block ): array {
	$mode     = $block['mode'] ?? 'auto';
	$content  = is_array( $block['content'] ?? null ) ? $block['content'] : array();
	$category = $block['category'] ?? ( $content['category'] ?? null );
	$count    = (int) ( $block['count'] ?? $block['posts_per_page'] ?? $content['posts_per_page'] ?? 3 );
	$count    = max( 1, min( 12, $count ) );

	if ( 'manual' === $mode && ! empty( $block['selection'] ) && is_array( $block['selection'] ) ) {
		$ids = array_values( array_filter( array_map( 'absint', $block['selection'] ) ) );

		if ( empty( $ids ) ) {
			return array();
		}

		$posts = \Timber\Timber::get_posts(
			array(
				'post_type'      => 'post',
				'post__in'       => $ids,
				'orderby'        => 'post__in',
				'posts_per_page' => count( $ids ),
				'post_status'    => 'publish',
			)
		);

		return $posts ? iterator_to_array( $posts, false ) : array();
	}

	$query = array(
		'post_type'           => 'post',
		'posts_per_page'      => $count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	);

	if ( ! empty( $category ) ) {
		$term_id = is_array( $category ) ? (int) ( $category[0] ?? 0 ) : (int) $category;

		if ( $term_id > 0 ) {
			$query['cat'] = $term_id;
		}
	}

	$posts = \Timber\Timber::get_posts( $query );

	return $posts ? iterator_to_array( $posts, false ) : array();
}

/**
 * Demo case study cards for starter installs without a case_study CPT.
 *
 * @param array<int, array<string, mixed>> $items Resolved cards.
 * @param array<string, mixed>             $block ACF layout row.
 * @return array<int, array<string, mixed>>
 */
function cinq_starter_demo_case_study_items( array $items, array $block ): array {
	if ( ! empty( $items ) || post_type_exists( 'case_study' ) ) {
		return $items;
	}

	unset( $block );

	return cinq_starter_demo_case_study_cards();
}
