<?php
/**
 * Category Archive
 *
 * This class extends Timber\Term.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\Term;

/**
 * Extends Timber\Term
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models
 */
class Category extends Term {
	/**
	 * Example method
	 *
	 * Will be available in Twig as {{ term.foo }}
	 *
	 * @return string
	 */
	public function foo(): string {
		return 'foo';
	}
}
