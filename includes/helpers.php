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
		&& ! empty( $block['accordions'] )
		&& is_array( $block['accordions'] )
	) {
		$faq_schema = cinq_faq_schema_json( $block['accordions'] );

		if ( '' !== $faq_schema ) {
			$block['faq_schema_json'] = $faq_schema;
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
		$question = isset( $item['header'] ) ? wp_strip_all_tags( (string) $item['header'] ) : '';
		$answer   = isset( $item['content'] ) ? wp_strip_all_tags( (string) $item['content'] ) : '';

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
