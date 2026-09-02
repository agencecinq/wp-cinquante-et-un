<?php
/**
 * Search form
 *
 * Custom markup for get_search_form().
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

use Timber\Timber;

Timber::render(
	'components/search-form.html.twig',
	array_merge(
		Timber::context(),
		array(
			'classes' => isset( $args['classes'] ) ? (array) $args['classes'] : array(),
		)
	)
);
