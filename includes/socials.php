<?php
/**
 * Socials configuration
 *
 * Useful to define social media links and sharing options.
 *
 * @package Nexiode
 */

return array(
	array(
		'id'          => 'facebook',
		'title'       => __( 'Facebook', 'nexiode' ),
		'placeholder' => 'https://facebook.com/artvandelay',
		'description' => __( 'Enter the Facebook URL here.', 'nexiode' ),
		'url'         => get_option( 'socials' )['facebook'] ?? '',
		'name'        => __( 'Share on Facebook', 'nexiode' ),
		'color'       => '#1877f2',
		'link'        => 'https://www.facebook.com/sharer.php?u=',
	),
	array(
		'id'          => 'instagram',
		'title'       => __( 'Instagram', 'nexiode' ),
		'placeholder' => 'https://instagram.com/artvandelay',
		'description' => __( 'Enter the Instagram URL here.', 'nexiode' ),
		'url'         => get_option( 'socials' )['instagram'] ?? '',
		'color'       => '#405de6',
	),
	array(
		'id'          => 'linkedin',
		'title'       => __( 'LinkedIn', 'nexiode' ),
		'placeholder' => 'https://linkedin.com/artvandelay',
		'description' => __( 'Enter the LinkedIn URL here.', 'nexiode' ),
		'url'         => get_option( 'socials' )['linkedin'] ?? '',
		'name'        => __( 'Share on LinkedIn', 'nexiode' ),
		'color'       => '#0a66c2',
		'link'        => 'https://www.linkedin.com/sharing/share-offsite/?url=',
	),
	array(
		'id'          => 'vimeo',
		'title'       => __( 'Vimeo', 'nexiode' ),
		'placeholder' => 'https://vimeo.com/artvandelay',
		'description' => __( 'Enter the Vimeo URL here.', 'nexiode' ),
		'url'         => get_option( 'socials' )['vimeo'] ?? '',
	),
	array(
		'id'          => 'x',
		'title'       => __( 'X (Twitter)', 'nexiode' ),
		'placeholder' => 'https://x.com/artvandelay',
		'description' => __( 'Enter the X URL here.', 'nexiode' ),
		'url'         => get_option( 'socials' )['x'] ?? '',
		'link'        => 'http://twitter.com/share?url=',
		'name'        => __( 'Share on X', 'nexiode' ),
	),
	array(
		'id'          => 'youtube',
		'title'       => __( 'YouTube', 'nexiode' ),
		'placeholder' => 'https://youtube.com/artvandelay',
		'description' => __( 'Enter the YouTube URL here.', 'nexiode' ),
		'url'         => get_option( 'socials' )['youtube'] ?? '',
		'color'       => '#ff0000',
	),
);
