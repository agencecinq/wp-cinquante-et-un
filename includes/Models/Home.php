<?php
/**
 * Home Model
 *
 * Custom model for home archive page.
 *
 * @package WordPress
 * @subpackage Nexiode/Models
 */

namespace Nexiode\Models;

use Timber\{ Post, Timber };
use Nexiode\Traits\ArchivePost;

/**
 * Class Home
 *
 * Represents the custom model for the home archive page.
 * Extends Timber\Post and uses ArchivePostTrait for additional archive functionality.
 *
 * In order to use the post/classmap and because Timber is waiting for a Timber\Post, we extract logic for featured posts and recent posts in a trait.
 *
 * @package Nexiode\Models
 */
class Home extends Post {
	use ArchivePost;
}
