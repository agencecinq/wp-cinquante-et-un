<?php
/**
 * Styleguide catalog: kernel blocks without layout variants.
 *
 * @package WordPress
 * @subpackage WPCinquanteEtUn/Models/Styleguide/Catalogs
 * @author CINQ <contact@agencecinq.com> (https://agencecinq.com)
 */

namespace WPCinquanteEtUn\Models\Styleguide\Catalogs;

use WPCinquanteEtUn\Models\Styleguide\StyleguideContext;
use WPCinquanteEtUn\Models\Styleguide\StyleguideEntry;

/**
 * StandardBlocksCatalog
 */
class StandardBlocksCatalog {

	/**
	 * Single-entry kernel blocks in catalog order.
	 *
	 * @param StyleguideContext $context Shared fixtures.
	 * @return array<int, array<string, mixed>>
	 */
	public static function entries( StyleguideContext $context ): array {
		$layout     = $context->layout();
		$layout_cta = $context->layout_cta();
		$image      = StyleguideContext::placeholder_image( 1600, 900 );
		$logo       = StyleguideContext::placeholder_image( 150, 32 );
		$avatar     = StyleguideContext::placeholder_image( 80, 80 );
		$posts      = $context->posts();

		return array(
			StyleguideEntry::single(
				'styleguide-layout-logos',
				__( 'Logos', 'wp-cinquante-et-un' ),
				'blocks/logos.html.twig',
				array(
					'id'        => 'styleguide-logos',
					'layout'    => $layout,
					'title'     => __( 'They trust us', 'wp-cinquante-et-un' ),
					'grayscale' => true,
					'logos'     => array( $logo, $logo, $logo, $logo, $logo, $logo ),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-cards-grid',
				__( 'Cards Grid', 'wp-cinquante-et-un' ),
				'blocks/cards-grid.html.twig',
				array(
					'id'       => 'styleguide-cards-grid',
					'layout'   => $layout,
					'columns'  => 3,
					'overline' => __( 'Expertise', 'wp-cinquante-et-un' ),
					'title'    => __( 'What we do', 'wp-cinquante-et-un' ),
					'cards'    => array(
						array(
							'icon'  => StyleguideContext::placeholder_image( 32, 32 ),
							'title' => __( 'Site build', 'wp-cinquante-et-un' ),
							'text'  => __( 'Custom Timber theme, tailored ACF blocks. In your Git repo from the first commit.', 'wp-cinquante-et-un' ),
							'link'  => array(
								'title' => __( 'Our method', 'wp-cinquante-et-un' ),
								'url'   => '#',
							),
						),
						array(
							'icon'  => StyleguideContext::placeholder_image( 32, 32 ),
							'title' => __( 'Redesign', 'wp-cinquante-et-un' ),
							'text'  => __( 'Page by page, with the editorial structure rebuilt. Content and SEO are kept.', 'wp-cinquante-et-un' ),
							'link'  => array(
								'title' => __( 'Our method', 'wp-cinquante-et-un' ),
								'url'   => '#',
							),
						),
						array(
							'icon'  => StyleguideContext::placeholder_image( 32, 32 ),
							'title' => __( 'Maintenance', 'wp-cinquante-et-un' ),
							'text'  => __( 'Updates, backups, monitoring, and retainers. Corrective hotfixes follow the SLA.', 'wp-cinquante-et-un' ),
							'link'  => array(
								'title' => __( 'Our method', 'wp-cinquante-et-un' ),
								'url'   => '#',
							),
						),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-key-figures',
				__( 'Key Figures', 'wp-cinquante-et-un' ),
				'blocks/key-figures.html.twig',
				array(
					'id'       => 'styleguide-key-figures',
					'layout'   => $layout,
					'overline' => __( 'Results', 'wp-cinquante-et-un' ),
					'title'    => __( 'What it changes, in practice', 'wp-cinquante-et-un' ),
					'figures'  => array(
						array(
							'value'  => '+68',
							'suffix' => '%',
							'label'  => __( 'more quote requests in six months', 'wp-cinquante-et-un' ),
						),
						array(
							'value'  => '1.4',
							'suffix' => 's',
							'label'  => __( 'median LCP on mobile', 'wp-cinquante-et-un' ),
						),
						array(
							'value'  => '95',
							'suffix' => '+',
							'label'  => __( 'PageSpeed score on mobile', 'wp-cinquante-et-un' ),
						),
						array(
							'value'  => '0',
							'suffix' => '',
							'label'  => __( 'page builder plugins', 'wp-cinquante-et-un' ),
						),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-case-studies',
				__( 'Case Studies', 'wp-cinquante-et-un' ),
				'blocks/case-studies.html.twig',
				array(
					'id'            => 'styleguide-case-studies',
					'acf_fc_layout' => 'case_studies',
					'layout'        => $layout,
					'mode'          => 'manual',
					'columns'       => 3,
					'hide_if_empty' => true,
					'overline'      => __( 'Work', 'wp-cinquante-et-un' ),
					'title'         => __( 'Projects that last', 'wp-cinquante-et-un' ),
					'link'          => array(
						'title' => __( 'All case studies', 'wp-cinquante-et-un' ),
						'url'   => '#',
					),
					'items'         => array(
						array(
							'image'        => $image,
							'sector'       => __( 'Industry', 'wp-cinquante-et-un' ),
							'client'       => 'Nexiode',
							'title'        => __( 'Corporate site and configurator rebuild', 'wp-cinquante-et-un' ),
							'url'          => '#',
							'result_value' => '+68 %',
							'result_label' => __( 'quote requests', 'wp-cinquante-et-un' ),
						),
						array(
							'image'        => $image,
							'sector'       => __( 'Industry', 'wp-cinquante-et-un' ),
							'client'       => 'Laffargue',
							'title'        => __( 'Editorial platform and dealer space', 'wp-cinquante-et-un' ),
							'url'          => '#',
							'result_value' => '1.4 s',
							'result_label' => __( 'LCP on mobile', 'wp-cinquante-et-un' ),
						),
						array(
							'image'        => $image,
							'sector'       => __( 'Industry', 'wp-cinquante-et-un' ),
							'client'       => 'Beau Nuage',
							'title'        => __( 'Brochure site rebuild', 'wp-cinquante-et-un' ),
							'url'          => '#',
							'result_value' => '2.3x',
							'result_label' => __( 'conversion rate', 'wp-cinquante-et-un' ),
						),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-testimonials',
				__( 'Testimonials', 'wp-cinquante-et-un' ),
				'blocks/testimonials.html.twig',
				array(
					'id'            => 'styleguide-testimonials',
					'acf_fc_layout' => 'testimonials',
					'layout'        => $layout,
					'source'        => 'manual',
					'columns'       => 3,
					'overline'      => __( 'Client feedback', 'wp-cinquante-et-un' ),
					'title'         => __( 'What they say', 'wp-cinquante-et-un' ),
					'items'         => array(
						array(
							'quote'   => __( 'They refused the easy option and took the time to understand our work. The back office is finally usable by the communications team.', 'wp-cinquante-et-un' ),
							'author'  => 'Sophie Lemarchand',
							'role'    => __( 'Communications director', 'wp-cinquante-et-un' ),
							'company' => 'Nexiode',
							'avatar'  => $avatar,
						),
						array(
							'quote'   => __( 'The site went from 4.2 s to 1.4 s load time. Quote requests followed, without touching the ad budget.', 'wp-cinquante-et-un' ),
							'author'  => 'Marc Vandenberghe',
							'role'    => __( 'Managing director', 'wp-cinquante-et-un' ),
							'company' => 'Laffargue',
							'avatar'  => $avatar,
						),
						array(
							'quote'   => __( 'Three years after launch, we still edit everything ourselves. No lock-in, no surprise invoices.', 'wp-cinquante-et-un' ),
							'author'  => 'Ines Bakouche',
							'role'    => __( 'Marketing lead', 'wp-cinquante-et-un' ),
							'company' => 'Zeta',
							'avatar'  => $avatar,
						),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-team',
				__( 'Team', 'wp-cinquante-et-un' ),
				'blocks/team.html.twig',
				array(
					'id'            => 'styleguide-team',
					'acf_fc_layout' => 'team',
					'layout'        => $layout,
					'columns'       => 4,
					'show_bio'      => false,
					'overline'      => __( 'The agency', 'wp-cinquante-et-un' ),
					'title'         => __( 'The people behind the projects', 'wp-cinquante-et-un' ),
					'members'       => array(
						array(
							'name'    => 'Camille Roussel',
							'role'    => __( 'Creative director', 'wp-cinquante-et-un' ),
							'photo'   => StyleguideContext::placeholder_image( 320, 427 ),
							'socials' => array(
								'linkedin' => array(
									'url' => '#',
								),
							),
						),
						array(
							'name'    => 'Thomas Aubert',
							'role'    => __( 'Lead developer', 'wp-cinquante-et-un' ),
							'photo'   => StyleguideContext::placeholder_image( 320, 427 ),
							'socials' => array(
								'linkedin' => array(
									'url' => '#',
								),
							),
						),
						array(
							'name'    => 'Naïma Cherif',
							'role'    => __( 'Project manager', 'wp-cinquante-et-un' ),
							'photo'   => StyleguideContext::placeholder_image( 320, 427 ),
							'socials' => array(
								'linkedin' => array(
									'url' => '#',
								),
							),
						),
						array(
							'name'    => 'Julien Marec',
							'role'    => __( 'SEO consultant', 'wp-cinquante-et-un' ),
							'photo'   => StyleguideContext::placeholder_image( 320, 427 ),
							'socials' => array(
								'linkedin' => array(
									'url' => '#',
								),
							),
						),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-accordion-group',
				__( 'FAQ', 'wp-cinquante-et-un' ),
				'blocks/accordion-group.html.twig',
				array(
					'id'            => 'styleguide-accordion-group',
					'acf_fc_layout' => 'accordion_group',
					'layout'        => $layout,
					'schema'        => true,
					'overline'      => __( 'FAQ', 'wp-cinquante-et-un' ),
					'title'         => __( 'What we get asked most', 'wp-cinquante-et-un' ),
					'items'         => array(
						array(
							'question' => __( 'How long does a redesign take?', 'wp-cinquante-et-un' ),
							'answer'   => __( 'Eight to twelve weeks for a brochure site of about thirty pages, including scoping. The bottleneck is almost never development: it is content production.', 'wp-cinquante-et-un' ),
						),
						array(
							'question' => __( 'Can you take over an existing site?', 'wp-cinquante-et-un' ),
							'answer'   => __( 'Yes. We audit the theme, plugins, and content, then rebuild what cannot be maintained. URLs and SEO are mapped before anything goes live.', 'wp-cinquante-et-un' ),
						),
						array(
							'question' => __( 'What happens after launch?', 'wp-cinquante-et-un' ),
							'answer'   => __( 'You edit the content. We stay on for updates, backups, and the work that needs code. The retainer matches the SLA, not a surprise invoice.', 'wp-cinquante-et-un' ),
						),
						array(
							'question' => __( 'Do you work with third-party plugins?', 'wp-cinquante-et-un' ),
							'answer'   => __( 'ACF is the only plugin in the kernel. Project adapters (forms, SEO, CRM) are wired per site, not baked into the starter.', 'wp-cinquante-et-un' ),
						),
						array(
							'question' => __( 'Do we really own the code?', 'wp-cinquante-et-un' ),
							'answer'   => __( 'Yes. The theme lives in your Git repository from the first commit. No page builder, no proprietary lock-in.', 'wp-cinquante-et-un' ),
						),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-form',
				__( 'Form', 'wp-cinquante-et-un' ),
				'blocks/form.html.twig',
				array(
					'id'          => 'styleguide-form',
					'layout'      => $layout,
					'form_layout' => 'split',
					'overline'    => __( 'Contact', 'wp-cinquante-et-un' ),
					'title'       => __( 'Let\'s talk about your project', 'wp-cinquante-et-un' ),
					'text'        => '<p>' . __( 'Describe your need in a few lines. We reply within two business days, and the first call is always free.', 'wp-cinquante-et-un' ) . '</p>',
					'form_id'     => null,
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-contact',
				__( 'Contact', 'wp-cinquante-et-un' ),
				'blocks/contact.html.twig',
				array(
					'id'        => 'styleguide-contact',
					'layout'    => $layout,
					'schema'    => true,
					'title'     => __( 'Find us', 'wp-cinquante-et-un' ),
					'address'   => '12 rue de la Fosse aux Chênes<br>59100 Roubaix',
					'phone'     => '01 23 45 67 89',
					'email'     => 'bonjour@agencecinq.com',
					'hours'     => array(
						array(
							'days'  => __( 'Monday to Friday', 'wp-cinquante-et-un' ),
							'hours' => __( '9 am – 6 pm', 'wp-cinquante-et-un' ),
						),
					),
					'map_image' => StyleguideContext::placeholder_image( 960, 640 ),
					'map_link'  => 'https://maps.google.com/',
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-cta',
				__( 'CTA', 'wp-cinquante-et-un' ),
				'blocks/cta.html.twig',
				array(
					'id'          => 'styleguide-cta',
					'layout'      => $layout_cta,
					'title'       => __( 'A new site or a redesign?', 'wp-cinquante-et-un' ),
					'text'        => __( 'Thirty minutes is enough to know if we are the right partner. No commitment, and no sales pitch.', 'wp-cinquante-et-un' ),
					'cta_primary' => array(
						'title' => __( 'Book a call', 'wp-cinquante-et-un' ),
						'url'   => '#',
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-columns',
				__( 'Columns', 'wp-cinquante-et-un' ),
				'blocks/columns.html.twig',
				array(
					'id'      => 'styleguide-columns',
					'layout'  => $layout,
					'content' => array(
						'column_left'  => '<p>' . esc_html__( 'Your site is not an expense to write off every three years.', 'wp-cinquante-et-un' ) . '</p>',
						'column_right' => '<p>' . esc_html__( 'It is an asset you build to last, and you evolve it with the company.', 'wp-cinquante-et-un' ) . '</p>',
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-gallery',
				__( 'Gallery', 'wp-cinquante-et-un' ),
				'blocks/gallery.html.twig',
				array(
					'id'             => 'styleguide-gallery',
					'layout'         => $layout,
					'marquee'        => false,
					'images_per_row' => 4,
					'content'        => array(
						'title'   => __( 'Gallery', 'wp-cinquante-et-un' ),
						'gallery' => array( $image, $image, $image, $image ),
					),
				)
			),
			StyleguideEntry::single(
				'styleguide-layout-latest-posts',
				__( 'Latest posts', 'wp-cinquante-et-un' ),
				'blocks/latest-posts.html.twig',
				array(
					'id'            => 'styleguide-latest-posts',
					'acf_fc_layout' => 'latest_posts',
					'layout'        => $layout,
					'mode'          => 'manual',
					'columns'       => 4,
					'hide_if_empty' => true,
					'overline'      => __( 'Journal', 'wp-cinquante-et-un' ),
					'title'         => __( 'Latest posts', 'wp-cinquante-et-un' ),
					'link'          => array(
						'title' => __( 'View all posts', 'wp-cinquante-et-un' ),
						'url'   => '#',
					),
					'posts'         => $posts,
				)
			),
		);
	}
}
