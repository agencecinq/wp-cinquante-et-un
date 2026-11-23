<?php
/**
 * Color configuration
 *
 * Single source of the theme colors, mirroring the Figma variables of the
 * project: a Primitives collection, the roles of a Couleurs collection, and
 * its modes as color schemes (Clair is the default scheme, Sombre is `dark`).
 * Feeds the front (`cinq_colors_css()`, printed in the head), the ACF scheme
 * swatches and the styleguide. Tailwind only knows the role names
 * (`@theme reference` in theme.css), never their values.
 * Auto-loaded via composer.json "files".
 *
 * @package WPCinquanteEtUn
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

/**
 * Primitives (slug => label + value), printed as `--palette-{slug}`.
 *
 * Starter wireframe: ink and grays. A project replaces these values with
 * its Figma primitives, role names stay. Templates never use primitives:
 * they paint with roles.
 *
 * @return array<string, array{label: string, value: string}>
 */
function cinq_palette(): array {
	return array(
		'ink'          => array(
			'label' => __( 'Ink', 'wp-cinquante-et-un' ),
			'value' => '#2a343a',
		),
		'gray-dark'    => array(
			'label' => __( 'Dark gray', 'wp-cinquante-et-un' ),
			'value' => '#555555',
		),
		'gray'         => array(
			'label' => __( 'Gray', 'wp-cinquante-et-un' ),
			'value' => '#8b8b8b',
		),
		'gray-light'   => array(
			'label' => __( 'Light gray', 'wp-cinquante-et-un' ),
			'value' => '#e5e5e5',
		),
		'gray-lighter' => array(
			'label' => __( 'Lighter gray', 'wp-cinquante-et-un' ),
			'value' => '#f5f5f5',
		),
		'white'        => array(
			'label' => __( 'White', 'wp-cinquante-et-un' ),
			'value' => '#ffffff',
		),
		'red'          => array(
			'label' => __( 'Red', 'wp-cinquante-et-un' ),
			'value' => '#b42318',
		),
		'success'      => array(
			'label' => __( 'Success', 'wp-cinquante-et-un' ),
			'value' => '#176640',
		),
	);
}

/**
 * Color roles (CSS custom property => Figma variable of the Couleurs collection).
 *
 * The property picks the Tailwind namespace: `--text-color-primary` makes
 * `text-primary`, `--background-color-page` makes `bg-page`. It is also the
 * code syntax of the Figma variable.
 *
 * @return array<string, string>
 */
function cinq_scheme_roles(): array {
	return array(
		'text-color-primary'                    => 'text/primary',
		'text-color-secondary'                  => 'text/secondary',
		'text-color-inverse'                    => 'text/inverse',
		'text-color-accent-inverse'             => 'text/accent-inverse',
		'text-color-error'                      => 'text/error',
		'text-color-success'                    => 'text/success',
		'background-color-page'                 => 'bg/page',
		'background-color-surface'              => 'bg/surface',
		'background-color-white'                => 'bg/white',
		'background-color-inverse'              => 'bg/inverse',
		'background-color-media'                => 'bg/media',
		'background-color-accent'               => 'bg/accent',
		'border-color-default'                  => 'border/default',
		'border-color-field'                    => 'border/field',
		'border-color-inverse'                  => 'border/inverse',
		'border-color-error'                    => 'border/error',
		'background-color-button-primary'       => 'button/primary-bg',
		'text-color-button-primary'             => 'button/primary-text',
		'background-color-button-primary-hover' => 'button/primary-bg-hover',
		'text-color-button-primary-hover'       => 'button/primary-text-hover',
		'color-icon'                            => 'icon/default',
		'color-icon-inverse'                    => 'icon/inverse',
		'color-accent'                          => 'accent',
		'color-ornament'                        => 'ornament',
		'color-focus-ring'                      => 'focus/ring',
		'color-focus-ring-inverse'              => 'focus/ring-inverse',
		'color-overlay-scrim'                   => 'overlay/scrim',
	);
}

/**
 * Color schemes (slug => label + role colors), applied with `data-scheme`.
 *
 * `''` and `dark` are the Figma modes Clair and Sombre. `surface` and `white`
 * are Clair sections painted with bg/surface or bg/white. A role color is a
 * primitive slug or another role of the same scheme. The empty slug is set on
 * `:root`.
 *
 * @return array<string, array{label: string, colors: array<string, string>}>
 */
function cinq_schemes(): array {
	$light = array(
		'text-color-primary'                    => 'ink',
		'text-color-secondary'                  => 'gray-dark',
		'text-color-inverse'                    => 'white',
		'text-color-accent-inverse'             => 'white',
		'text-color-error'                      => 'red',
		'text-color-success'                    => 'success',
		'background-color-page'                 => 'white',
		'background-color-surface'              => 'gray-lighter',
		'background-color-white'                => 'white',
		'background-color-inverse'              => 'ink',
		'background-color-media'                => 'gray-light',
		'background-color-accent'               => 'gray-light',
		'border-color-default'                  => 'ink',
		'border-color-field'                    => 'gray',
		'border-color-inverse'                  => 'white',
		'border-color-error'                    => 'red',
		'background-color-button-primary'       => 'ink',
		'text-color-button-primary'             => 'white',
		'background-color-button-primary-hover' => 'gray-dark',
		'text-color-button-primary-hover'       => 'white',
		'color-icon'                            => 'ink',
		'color-icon-inverse'                    => 'white',
		'color-accent'                          => 'ink',
		'color-ornament'                        => 'gray',
		'color-focus-ring'                      => 'ink',
		'color-focus-ring-inverse'              => 'white',
		'color-overlay-scrim'                   => 'ink',
	);

	return array(
		''        => array(
			'label'  => __( 'Default', 'wp-cinquante-et-un' ),
			'colors' => $light,
		),
		'surface' => array(
			'label'  => __( 'Surface', 'wp-cinquante-et-un' ),
			'colors' => array_merge( $light, array( 'background-color-page' => 'background-color-surface' ) ),
		),
		'white'   => array(
			'label'  => __( 'White', 'wp-cinquante-et-un' ),
			'colors' => array_merge( $light, array( 'background-color-page' => 'background-color-white' ) ),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'wp-cinquante-et-un' ),
			'colors' => array_merge(
				$light,
				array(
					'text-color-primary'              => 'white',
					'text-color-secondary'            => 'gray-light',
					'text-color-inverse'              => 'ink',
					'text-color-accent-inverse'       => 'ink',
					'text-color-error'                => 'white',
					'text-color-success'              => 'white',
					'background-color-page'           => 'ink',
					'background-color-surface'        => 'ink',
					'background-color-white'          => 'ink',
					'background-color-inverse'        => 'white',
					'border-color-default'            => 'white',
					'border-color-inverse'            => 'ink',
					'border-color-error'              => 'white',
					'background-color-button-primary' => 'white',
					'text-color-button-primary'       => 'ink',
					'background-color-button-primary-hover' => 'gray-light',
					'text-color-button-primary-hover' => 'ink',
					'color-icon'                      => 'white',
					'color-icon-inverse'              => 'ink',
					'color-accent'                    => 'white',
					'color-focus-ring'                => 'white',
					'color-focus-ring-inverse'        => 'ink',
					'color-overlay-scrim'             => 'ink',
				)
			),
		),
	);
}

/**
 * Resolved value of a scheme role (follows role references to the palette).
 *
 * @param string $scheme Scheme slug.
 * @param string $role   Role (CSS custom property without the dashes).
 * @return string Hex color or `transparent`.
 */
function cinq_scheme_color( string $scheme, string $role ): string {
	$color = cinq_schemes()[ $scheme ]['colors'][ $role ] ?? 'transparent';

	if ( isset( cinq_scheme_roles()[ $color ] ) ) {
		return cinq_scheme_color( $scheme, $color );
	}

	return cinq_palette()[ $color ]['value'] ?? 'transparent';
}

/**
 * Front color variables: primitives and default roles on `:root`, one rule per scheme.
 *
 * @return string CSS.
 */
function cinq_colors_css(): string {
	$roles = static function ( array $colors ): string {
		$css = '';

		foreach ( $colors as $role => $color ) {
			$value = isset( cinq_scheme_roles()[ $color ] ) ? 'var(--' . $color . ')' : 'var(--palette-' . $color . ')';
			$css  .= '--' . $role . ':' . $value . ';';
		}

		return $css;
	};

	$css = ':root{';

	foreach ( cinq_palette() as $slug => $color ) {
		$css .= '--palette-' . $slug . ':' . $color['value'] . ';';
	}

	$css .= $roles( cinq_schemes()['']['colors'] ) . '}';

	foreach ( cinq_schemes() as $slug => $scheme ) {
		if ( '' === $slug ) {
			continue;
		}

		$css .= '[data-scheme="' . $slug . '"]{' . $roles( $scheme['colors'] ) . '}';
	}

	return $css;
}
