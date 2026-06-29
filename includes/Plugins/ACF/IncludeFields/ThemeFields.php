<?php
/**
 * Theme Fields
 *
 * Registers ACF field group for the theme options page (Réglages > Thème).
 *
 * @package WordPress
 * @subpackage Nexiode/Plugins/ACF/IncludeFields
 */

namespace Nexiode\Plugins\ACF\IncludeFields;

use Nexiode\Service;

/**
 * Theme Fields
 *
 * Loads advanced custom fields for the theme options.
 */
class ThemeFields implements Service {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'acf/include_fields', array( $this, 'fields' ) );
	}

	/**
	 * Registers the field group.
	 *
	 * @return void
	 */
	public function fields(): void {
		$key = 'theme_fields';

		$location = array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'options-theme',
				),
			),
		);

		$fields = array(
			array(
				'key'        => 'field_' . $key . '_theme_tab',
				'label'      => __( 'Theme', 'nexiode' ),
				'name'       => 'theme_tab',
				'aria-label' => __( 'Theme', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_theme',
				'label'      => __( 'Theme', 'nexiode' ),
				'name'       => 'theme',
				'aria-label' => __( 'Theme', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'        => 'field_' . $key . '_theme_footer_tab',
						'label'      => __( 'Footer', 'nexiode' ),
						'name'       => 'footer_tab',
						'aria-label' => __( 'Footer', 'nexiode' ),
						'type'       => 'tab',
					),
					array(
						'key'        => 'field_' . $key . '_theme_footer',
						'label'      => __( 'Footer', 'nexiode' ),
						'name'       => 'footer',
						'aria-label' => __( 'Footer', 'nexiode' ),
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'        => 'field_' . $key . '_theme_footer_push',
								'label'      => __( 'Push', 'nexiode' ),
								'name'       => 'push',
								'aria-label' => __( 'Push', 'nexiode' ),
								'type'       => 'group',
								'layout'     => 'block',
								'sub_fields' => array(
									array(
										'key'          => 'field_' . $key . '_theme_footer_push_title',
										'label'        => __( 'Title', 'nexiode' ),
										'name'         => 'title',
										'aria-label'   => __( 'Title', 'nexiode' ),
										'type'         => 'text',
										'placeholder'  => __( 'Title', 'nexiode' ),
										'instructions' => __( 'Heading for the footer push block.', 'nexiode' ),
									),
									array(
										'key'           => 'field_' . $key . '_theme_footer_push_choices',
										'label'         => __( 'Choices', 'nexiode' ),
										'name'          => 'choices',
										'aria-label'    => __( 'Choices', 'nexiode' ),
										'type'          => 'textarea',
										'rows'          => 6,
										'default_value' => "Éclairage public\nÉquipements urbains\nÉquipements sportifs\nTertiaire\nSolaire Connecté",
										'instructions'  => __( 'One choice per line. Used for input radio buttons in the footer and the select in the form.', 'nexiode' ),
									),
									array(
										'key'           => 'field_' . $key . '_theme_footer_push_image',
										'label'         => __( 'Image', 'nexiode' ),
										'name'          => 'image',
										'aria-label'    => __( 'Image', 'nexiode' ),
										'type'          => 'image',
										'return_format' => 'id',
										'preview_size'  => 'medium',
										'instructions'  => __( 'Select or upload an image.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									),
								),
							),
							array(
								'key'        => 'field_' . $key . '_theme_footer_newsletter',
								'label'      => __( 'Newsletter', 'nexiode' ),
								'name'       => 'newsletter',
								'aria-label' => __( 'Newsletter', 'nexiode' ),
								'type'       => 'group',
								'layout'     => 'block',
								'sub_fields' => array(
									array(
										'key'          => 'field_' . $key . '_theme_footer_newsletter_title',
										'label'        => __( 'Title', 'nexiode' ),
										'name'         => 'title',
										'aria-label'   => __( 'Title', 'nexiode' ),
										'type'         => 'textarea',
										'rows'         => 2,
										'new_lines'    => 'br',
										'placeholder'  => __( 'Title', 'nexiode' ),
										'instructions' => __( 'Heading for the newsletter block.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									),
									array(
										'key'          => 'field_' . $key . '_theme_footer_newsletter_subtitle',
										'label'        => __( 'Subtitle', 'nexiode' ),
										'name'         => 'subtitle',
										'aria-label'   => __( 'Subtitle', 'nexiode' ),
										'type'         => 'text',
										'placeholder'  => __( 'Subtitle', 'nexiode' ),
										'instructions' => __( 'Subtitle for the newsletter block.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									),
									array(
										'key'          => 'field_' . $key . '_theme_footer_newsletter_text',
										'label'        => __( 'Text', 'nexiode' ),
										'name'         => 'text',
										'aria-label'   => __( 'Text', 'nexiode' ),
										'type'         => 'textarea',
										'rows'         => 2,
										'new_lines'    => 'br',
										'placeholder'  => __( 'Text', 'nexiode' ),
										'instructions' => __( 'Text for the newsletter block.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									),
									array(
										'key'           => 'field_' . $key . '_theme_footer_newsletter_form',
										'label'         => __( 'Form', 'nexiode' ),
										'name'          => 'form',
										'aria-label'    => __( 'Form', 'nexiode' ),
										'type'          => 'post_object',
										'post_type'     => array( 'wpcf7_contact_form' ),
										'return_format' => 'id',
										'multiple'      => 0,
										'allow_null'    => 0,
										'ui'            => 1,
										'instructions'  => __( 'Select the Contact Form 7 form displayed in the footer.', 'nexiode' ),
									),
								),
							),

						),
					),
					array(
						'key'        => 'field_' . $key . '_theme_contact_tab',
						'label'      => __( 'Contact', 'nexiode' ),
						'name'       => 'contact_tab',
						'aria-label' => __( 'Contact', 'nexiode' ),
						'type'       => 'tab',
					),
					array(
						'key'        => 'field_' . $key . '_theme_contact',
						'label'      => __( 'Contact', 'nexiode' ),
						'name'       => 'contact',
						'aria-label' => __( 'Contact', 'nexiode' ),
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'           => 'field_' . $key . '_theme_contact_link',
								'label'         => __( 'Link', 'nexiode' ),
								'name'          => 'link',
								'aria-label'    => __( 'Link', 'nexiode' ),
								'type'          => 'link',
								'return_format' => 'array',
								'instructions'  => __( 'Enter the contact or CTA link URL.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
							),
						),
					),
					array(
						'key'        => 'field_' . $key . '_theme_404_tab',
						'label'      => __( '404', 'nexiode' ),
						'name'       => 'page_404_tab',
						'aria-label' => __( '404', 'nexiode' ),
						'type'       => 'tab',
					),
					array(
						'key'        => 'field_' . $key . '_theme_404',
						'label'      => '404',
						'name'       => '404',
						'aria-label' => '404',
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'           => 'field_' . $key . '_404_image',
								'label'         => __( 'Image', 'nexiode' ),
								'name'          => 'image',
								'aria-label'    => __( 'Image', 'nexiode' ),
								'type'          => 'image',
								'return_format' => 'id',
								'preview_size'  => 'medium',
								'instructions'  => __( 'Select or upload an image for the 404 page.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
							),
						),
					),
					array(
						'key'        => 'field_' . $key . '_theme_product_tab',
						'label'      => __( 'Product', 'nexiode' ),
						'name'       => 'product_tab',
						'aria-label' => __( 'Product', 'nexiode' ),
						'type'       => 'tab',
					),
					array(
						'key'        => 'field_' . $key . '_theme_product',
						'label'      => __( 'Product', 'nexiode' ),
						'name'       => 'product',
						'aria-label' => __( 'Product', 'nexiode' ),
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'        => 'field_' . $key . '_theme_product_modal',
								'label'      => __( 'Modal', 'nexiode' ),
								'name'       => 'modal',
								'aria-label' => __( 'Modal', 'nexiode' ),
								'type'       => 'group',
								'layout'     => 'block',
								'sub_fields' => array(
									array(
										'key'          => 'field_' . $key . '_theme_product_modal_title',
										'label'        => __( 'Title', 'nexiode' ),
										'name'         => 'title',
										'aria-label'   => __( 'Title', 'nexiode' ),
										'type'         => 'text',
										'placeholder'  => __( 'Title', 'nexiode' ),
										'instructions' => __( 'Heading for the product modal.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									),
									array(
										'key'          => 'field_' . $key . '_theme_product_modal_text',
										'label'        => __( 'Text', 'nexiode' ),
										'name'         => 'text',
										'aria-label'   => __( 'Text', 'nexiode' ),
										'type'         => 'textarea',
										'rows'         => 2,
										'new_lines'    => 'br',
										'placeholder'  => __( 'Text', 'nexiode' ),
										'instructions' => __( 'Text for the product modal.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
									),
									array(
										'key'           => 'field_' . $key . '_theme_product_modal_form',
										'label'         => __( 'Form', 'nexiode' ),
										'name'          => 'form',
										'aria-label'    => __( 'Form', 'nexiode' ),
										'type'          => 'post_object',
										'post_type'     => array( 'wpcf7_contact_form' ),
										'return_format' => 'id',
										'multiple'      => 0,
										'allow_null'    => 0,
										'ui'            => 1,
										'instructions'  => __( 'Select the Contact Form 7 form displayed in the modal.', 'nexiode' ),
									),
								),
							),
						),
					),
				),
			),
			array(
				'key'        => 'field_' . $key . '_menu_tab',
				'label'      => __( 'Menu', 'nexiode' ),
				'name'       => 'menu',
				'aria-label' => __( 'Menu', 'nexiode' ),
				'type'       => 'tab',
			),
			array(
				'key'        => 'field_' . $key . '_menus',
				'label'      => __( 'Menus', 'nexiode' ),
				'name'       => 'menus',
				'aria-label' => __( 'Menus', 'nexiode' ),
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'        => 'field_' . $key . '_menus_main',
						'label'      => __( 'Main Menu', 'nexiode' ),
						'name'       => 'main',
						'type'       => 'group',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_' . $key . '_menus_main_submenu',
								'label'        => __( 'Submenu', 'nexiode' ),
								'name'         => 'submenu',
								'type'         => 'repeater',
								'layout'       => 'block',
								'instructions' => __( 'Add submenu items. Each can have a menu, title, text, link title, and pushes.', 'nexiode' ),
								'button_label' => __( 'Add Submenu Item', 'nexiode' ),
								'sub_fields'   => array(
									array(
										'key'             => 'field_' . $key . '_menus_main_submenu_item',
										'label'           => __( 'Menu Item', 'nexiode' ),
										'name'            => 'item',
										'type'            => 'menu_item_select',
										'menu'            => get_nav_menu_locations()['main'],
										'return_format'   => 'value',
										'placeholder'     => __( 'Select a menu to attach to this submenu', 'nexiode' ),
										'allow_null'      => 1,
										'instructions'    => __( 'Select the menu to attach to this submenu.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
										'parent_repeater' => 'field_' . $key . '_menus_main_submenu',
									),
									array(
										'key'             => 'field_' . $key . '_menus_main_submenu_title',
										'label'           => __( 'Title', 'nexiode' ),
										'name'            => 'title',
										'type'            => 'text',
										'placeholder'     => __( 'Title', 'nexiode' ),
										'instructions'    => __( 'Submenu heading.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
										'parent_repeater' => 'field_' . $key . '_menus_main_submenu',
									),
									array(
										'key'             => 'field_' . $key . '_menus_main_submenu_text',
										'label'           => __( 'Text', 'nexiode' ),
										'name'            => 'text',
										'type'            => 'textarea',
										'rows'            => 2,
										'new_lines'       => 'br',
										'placeholder'     => __( 'Text', 'nexiode' ),
										'instructions'    => __( 'Short description.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
										'parent_repeater' => 'field_' . $key . '_menus_main_submenu',
									),
									array(
										'key'             => 'field_' . $key . '_menus_main_submenu_link_title',
										'label'           => __( 'Link Title', 'nexiode' ),
										'name'            => 'link_title',
										'type'            => 'text',
										'placeholder'     => __( 'Link Title', 'nexiode' ),
										'instructions'    => __( 'Button or link label.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
										'parent_repeater' => 'field_' . $key . '_menus_main_submenu',
									),
									array(
										'key'             => 'field_' . $key . '_menus_main_submenu_pushes',
										'label'           => __( 'Pushes', 'nexiode' ),
										'name'            => 'pushes',
										'type'            => 'repeater',
										'layout'          => 'block',
										'max'             => 4,
										'instructions'    => __( 'Add up to 3 push items (overline, title, image, link).', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
										'parent_repeater' => 'field_' . $key . '_menus_main_submenu',
										'button_label'    => __( 'Add Push', 'nexiode' ),
										'sub_fields'      => array(
											array(
												'key'     => 'field_' . $key . '_menus_main_submenu_pushes_mode',
												'label'   => __( 'Mode', 'nexiode' ),
												'name'    => 'mode',
												'type'    => 'select',
												'choices' => array(
													'dark' => __( 'Dark', 'nexiode' ),
													'light' => __( 'Light', 'nexiode' ),
												),
												'default' => 'dark',
												'return_format' => 'value',
												'parent_repeater' => 'field_' . $key . '_menus_main_submenu_pushes',
												'instructions' => __( 'Select the mode for the push.', 'nexiode' ) . ' <em>(' . __( 'Optional', 'nexiode' ) . ')</em>.',
											),
											array(
												'key'   => 'field_' . $key . '_menus_main_submenu_pushes_overline',
												'label' => __( 'Overline', 'nexiode' ),
												'name'  => 'overline',
												'type'  => 'text',
												'placeholder' => __( 'Overline', 'nexiode' ),
												'parent_repeater' => 'field_' . $key . '_menus_main_submenu_pushes',
											),
											array(
												'key'   => 'field_' . $key . '_menus_main_submenu_pushes_title',
												'label' => __( 'Title', 'nexiode' ),
												'name'  => 'title',
												'type'  => 'text',
												'placeholder' => __( 'Title', 'nexiode' ),
												'parent_repeater' => 'field_' . $key . '_menus_main_submenu_pushes',
											),
											array(
												'key'   => 'field_' . $key . '_menus_main_submenu_pushes_image',
												'label' => __( 'Image', 'nexiode' ),
												'name'  => 'image',
												'type'  => 'image',
												'return_format' => 'id',
												'preview_size' => 'medium',
											),
											array(
												'key'   => 'field_' . $key . '_menus_main_submenu_pushes_link',
												'label' => __( 'Link', 'nexiode' ),
												'name'  => 'link',
												'type'  => 'link',
												'return_format' => 'array',
												'parent_repeater' => 'field_' . $key . '_menus_main_submenu_pushes',
											),
										),
									),
								),
							),
						),
					),
				),
			),
		);

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key'      => 'group_' . $key,
					'title'    => __( 'Theme Fields', 'nexiode' ),
					'fields'   => $fields,
					'location' => $location,
				)
			);
		}
	}
}
