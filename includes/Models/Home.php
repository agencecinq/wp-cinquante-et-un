<?php
/**
 * Home Model
 *
 * Custom Timber model for the posts index (page_for_posts).
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Models
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models;

use Timber\Post;
use WPCinquanteEtUn\Traits\ArchivePost;

/**
 * Home
 */
class Home extends Post {
	use ArchivePost;
}
