<?php
/**
 * ACF layout: Products
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields/Layouts
 */

namespace Nexiode\Plugins\ACF\IncludeFields\Layouts;

use Nexiode\Plugins\ACF\IncludeFields\AcfFieldHelpers;

/**
 * Products block layout.
 */
class Products {

	/**
	 * Returns the layout array for the Products block.
	 *
	 * @param string $key The field key prefix (e.g. 'blocks' or 'archive_products').
	 * @return array<string, mixed>
	 */
	public static function get_layout( string $key ): array {
		return array(
			'key'        => 'layout_' . $key . '_products',
			'name'       => 'products',
			'label'      => __( 'Products', 'nexiode' ),
			'display'    => 'block',
			'sub_fields' => array(
				...AcfFieldHelpers::settings( $key . '_products' ),
				array(
					'key'        => 'field_' . $key . '_products_tab_content',
					'label'      => __( 'Content', 'nexiode' ),
					'aria-label' => __( 'Content', 'nexiode' ),
					'type'       => 'tab',
				),
				array(
					'key'         => 'field_' . $key . '_products_title',
					'label'       => __( 'Title', 'nexiode' ),
					'name'        => 'title',
					'aria-label'  => __( 'Title', 'nexiode' ),
					'type'        => 'text',
					'placeholder' => __( 'Enter the title of the block', 'nexiode' ),
				),
			),
		);
	}
}
