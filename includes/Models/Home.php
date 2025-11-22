<?php
/**
 * Home Model
 *
 * Custom model for home archive page.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\{ Post };

/**
 * Class Home
 *
 * Represents the custom model for the home archive page.
 *
 * @package WPCinquanteEtUn\Models
 */
class Home extends Post {

	/**
	 * Example method
	 *
	 * Will be available in Twig as {{ post.foo }}
	 *
	 * @return string
	 */
	public function foo() {
		return 'foo';
	}
}
