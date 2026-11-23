<?php
/**
 * ACF Field Type: Menu Item Select
 *
 * Allows selecting a single entry from a WordPress navigation menu.
 * Behaves like a native ACF Select / Relational field.
 *
 * @package WPCinquanteEtUn
 * @subpackage WPCinquanteEtUn/Plugins/ACF/FieldTypes
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Plugins\ACF\FieldTypes;

// phpcs:ignore Generic.Files.OneObjectStructurePerFile.MultipleFound
if ( ! class_exists( 'acf_field' ) ) {
	return;
}

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- Settings mirror the native ACF Select field and reuse its strings, translated by ACF.
/**
 * Class MenuItemSelect
 *
 * Custom ACF field type to select one item from a WordPress menu.
 * Stored value: nav menu item post ID.
 * Return format: 'value' (ID), 'object' (WP_Post), or 'array' (id, title, url).
 * Select2 and its strings come from the native ACF Select field, loaded on every ACF form.
 */
class MenuItemSelect extends \acf_field {

	/**
	 * Initializes the field type.
	 *
	 * @return void
	 */
	public function initialize(): void {
		$this->name        = 'menu_item_select';
		$this->label       = __( 'Menu Item Select', 'wp-cinquante-et-un' );
		$this->category    = 'relational';
		$this->description = __( 'Select a single entry from a WordPress navigation menu.', 'wp-cinquante-et-un' );
		$this->defaults    = array(
			'menu'          => '',
			'allow_null'    => 1,
			'return_format' => 'object',
			'placeholder'   => '',
			'ui'            => 1,
		);
	}

	/**
	 * Renders the field settings in the General tab.
	 *
	 * @param array $field The field array.
	 * @return void
	 */
	public function render_field_settings( $field ): void {
		$menus   = wp_get_nav_menus();
		$choices = array( '' => __( 'Select a menu', 'wp-cinquante-et-un' ) );

		foreach ( $menus as $menu ) {
			$choices[ (string) $menu->term_id ] = $menu->name;
		}

		acf_render_field_setting(
			$field,
			array(
				'label'        => __( 'Menu', 'wp-cinquante-et-un' ),
				'instructions' => __( 'Choose the menu from which to list items.', 'wp-cinquante-et-un' ),
				'name'         => 'menu',
				'type'         => 'select',
				'choices'      => $choices,
			)
		);

		acf_render_field_setting(
			$field,
			array(
				'label'        => __( 'Return Format', 'acf' ),
				'instructions' => __( 'Specify the value returned', 'acf' ),
				'type'         => 'radio',
				'name'         => 'return_format',
				'layout'       => 'horizontal',
				'choices'      => array(
					'value'  => __( 'Value', 'acf' ),
					'object' => __( 'Menu Item Object', 'wp-cinquante-et-un' ),
					'array'  => __( 'Both (Array)', 'acf' ),
				),
			)
		);
	}

	/**
	 * Renders the field settings in the Validation tab.
	 *
	 * @param array $field The field array.
	 * @return void
	 */
	public function render_field_validation_settings( $field ): void {
		acf_render_field_setting(
			$field,
			array(
				'label'        => __( 'Allow Null', 'acf' ),
				'instructions' => '',
				'name'         => 'allow_null',
				'type'         => 'true_false',
				'ui'           => 1,
			)
		);
	}

	/**
	 * Renders the field settings in the Presentation tab.
	 *
	 * @param array $field The field array.
	 * @return void
	 */
	public function render_field_presentation_settings( $field ): void {
		acf_render_field_setting(
			$field,
			array(
				'label'        => __( 'Stylized UI', 'acf' ),
				'instructions' => __( 'Use a stylized checkbox using select2', 'acf' ),
				'name'         => 'ui',
				'type'         => 'true_false',
				'ui'           => 1,
			)
		);

		acf_render_field_setting(
			$field,
			array(
				'label'        => __( 'Placeholder', 'acf' ),
				'instructions' => __( 'Appears within the input', 'acf' ),
				'type'         => 'text',
				'name'         => 'placeholder',
				'placeholder'  => _x( 'Select', 'verb', 'acf' ),
			)
		);
	}

	/**
	 * Prepares the field for display (default placeholder).
	 *
	 * @param array $field The field array.
	 * @return array
	 */
	public function prepare_field( $field ): array {
		if ( empty( $field['placeholder'] ) ) {
			$field['placeholder'] = _x( 'Select', 'verb', 'acf' );
		}
		return $field;
	}

	/**
	 * Loads the field: populates choices from the selected menu.
	 *
	 * @param array $field The field array.
	 * @return array
	 */
	public function load_field( $field ): array {
		$field['choices'] = array();

		if ( empty( $field['menu'] ) || ! is_numeric( $field['menu'] ) ) {
			return $field;
		}

		$items = wp_get_nav_menu_items( (int) $field['menu'] );

		if ( ! is_array( $items ) ) {
			return $field;
		}

		foreach ( $items as $item ) {
			if ( 0 !== (int) $item->menu_item_parent ) {
				continue;
			}
			$field['choices'][ (string) $item->ID ] = $item->title;
		}

		return $field;
	}

	/**
	 * Renders the field input using ACF's select input (same markup as native Select field).
	 *
	 * @param array $field The field array.
	 * @return void
	 */
	public function render_field( $field ): void {
		$value   = acf_get_array( $field['value'] );
		$choices = acf_get_array( $field['choices'] );

		if ( empty( $field['placeholder'] ) ) {
			$field['placeholder'] = _x( 'Select', 'verb', 'acf' );
		}

		if ( empty( $value ) ) {
			$value = array( '' );
		}

		if ( $field['allow_null'] ) {
			$choices = array( '' => "- {$field['placeholder']} -" ) + $choices;
		}

		$select = array(
			'id'               => $field['id'],
			'class'            => $field['class'],
			'name'             => $field['name'],
			'data-ui'          => $field['ui'],
			'data-multiple'    => 0,
			'data-placeholder' => $field['placeholder'],
			'data-allow_null'  => $field['allow_null'],
		);

		if ( ! empty( $field['aria-label'] ) ) {
			$select['aria-label'] = $field['aria-label'];
		}

		if ( ! empty( $field['readonly'] ) ) {
			$select['readonly'] = 'readonly';
		}
		if ( ! empty( $field['disabled'] ) ) {
			$select['disabled'] = 'disabled';
		}

		if ( $field['ui'] ) {
			acf_hidden_input(
				array(
					'id'   => $field['id'] . '-input',
					'name' => $field['name'],
				)
			);
		}

		$select['value']   = $value;
		$select['choices'] = $choices;

		acf_select_input( $select );
	}

	/**
	 * Load value: return scalar for single select (same as ACF Select).
	 *
	 * @param mixed $value   The value from the database.
	 * @param int   $post_id The post ID.
	 * @param array $field   The field array.
	 * @return mixed
	 */
	public function load_value( $value, $post_id, $field ) {
		return acf_unarray( $value );
	}

	/**
	 * Formats the value for use in templates.
	 *
	 * @param mixed $value   The value from the database.
	 * @param int   $post_id The post ID.
	 * @param array $field   The field array.
	 * @return mixed ID, WP_Post, array(id, title, url), or null.
	 */
	public function format_value( $value, $post_id, $field ) {
		if ( acf_is_empty( $value ) ) {
			return $field['allow_null'] ? null : $value;
		}

		$item_id = (int) $value;
		$item    = get_post( $item_id );

		if ( ! $item || 'nav_menu_item' !== $item->post_type ) {
			return $field['allow_null'] ? null : $value;
		}

		$url   = get_post_meta( $item_id, '_menu_item_url', true );
		$title = $item->post_title;

		if ( 'value' === $field['return_format'] ) {
			return $item_id;
		}

		if ( 'array' === $field['return_format'] ) {
			return array(
				'id'    => $item_id,
				'title' => $title,
				'url'   => $url,
			);
		}

		$item->url = $url;
		if ( empty( $item->post_title ) && $url ) {
			$item->post_title = $url;
		}
		return $item;
	}
}
// phpcs:enable WordPress.WP.I18n.TextDomainMismatch
