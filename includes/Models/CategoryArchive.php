<?php
/**
 * Category Archive Model
 *
 * Custom Timber model for category archives.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\Term;
use WPCinquanteEtUn\Traits\ArchivePost;

/**
 * CategoryArchive
 */
class CategoryArchive extends Term {
	use ArchivePost;
}
