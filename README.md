# WP CINQ – WordPress Starter Theme

**WP CINQ** is the agency's WordPress starter theme, built on Timber/Twig, Vite, Tailwind CSS v4 and TypeScript. It is the single source of truth for new client projects: every new project starts from this starter, never from a copy of the previous project.

It ships a generic, reusable foundation (block library, components, helpers, tooling) free of any client-specific content, so each project begins clean.

## Key features

- **Timber & Twig**: clean, reusable template components.
- **Modern tooling**: Composer, pnpm, Vite, TypeScript, PHP CodeSniffer (WPCS) and a GitHub release workflow.
- **Tailwind CSS v4**: design tokens declared in `@theme` (`src/stylesheets/theme.css`), no `tailwind.config.js`.
- **Accessibility**: semantic HTML, clear structure, ARIA best practices where relevant.
- **Performance**: optimized images (WebP, lazy‑loading), SVG sprite, minified assets in production.
- **Extensibility**: class‑based PHP in `includes/`, Twig components in `views/`, front‑end sources in `src/`.
- **ACF block library**: flexible page layouts (hero, cards grid, media + text, FAQ, …) with a styleguide catalogue.
- **Journal**: posts index, category and tag archives, single post with server-side table of contents.
- **Demo seeds**: WP-CLI scripts in `bin/` to populate a local site for development.

## Workflows (AI-assisted)

This repository carries Cursor rules in `.cursor/rules/` that document conventions and automate the two key flows. They are the operational reference for the team:

- **`starter-cinq`** (always on): stack, conventions, coding standards (WPCS), language rules, and the living DO/DONT list. This is the base of truth and is meant to evolve over time.
- **`init-nouveau-projet`**: step-by-step procedure to turn this starter into a new client project (detect and replace identifiers, reset tokens, fonts, icons and assets). Use it when starting a new project.
- **`remontee-vers-starter`**: the reverse flow. When something built on a project is reusable, this procedure brings it back into the starter (re-neutralize identifiers, strip client content, version bump).

To add a new DO/DONT or a task-specific rule, follow the "Faire évoluer ces règles" section of `starter-cinq`.

## Getting started from the starter

When creating a new project from this starter, follow the `init-nouveau-projet` rule, then:

```bash
composer install
pnpm install
pnpm build      # also generates public/sprite.svg from src/icons/
pnpm dev        # local dev server
```

Replace the placeholder assets (`screenshot.png`, `src/img/svg/logo.svg`). Colors use Tailwind utilities (`bg-white`, `text-black`, `text-gray-500`); override `--color-gray-*` in `src/stylesheets/theme.css` if the project palette differs. Type uses the system sans-serif stack; add project fonts via `src/fonts/` and/or Google Fonts. Corners are square.

### Template hierarchy

Root PHP files load the Timber context and render a single Twig view, with no conditional routing in `index.php`. Named page templates win over the default page flow.

| Entry point | Twig view | Purpose |
| --- | --- | --- |
| `index.php` | `index.html.twig` | Pages (default) and fallback |
| `home.php` | `pages/archive-post.html.twig` | Posts index |
| `category.php` | `pages/archive-post.html.twig` | Category archives |
| `tag.php` | `pages/archive-post.html.twig` | Tag archives |
| `single-post.php` | `pages/single-post.html.twig` | Single post |
| `search.php` | `pages/search.html.twig` | Search results |
| `404.php` | `pages/404.html.twig` | Not found |
| `page-templates/styleguide-page.php` | `pages/styleguide-page.html.twig` | Component and block catalogue |
| `page-templates/search-page.php` | `pages/search.html.twig` | Dedicated search landing page |

There is no `page.php` or `front-page.php`: content pages go through `index.php`. Project-specific CPT or taxonomy views follow the same pattern (`archive-<cpt>.php`, `single-<cpt>.php`, …).

### Page content

`index.html.twig` composes pages from up to three layers:

1. **Page header**: rendered when the first flexible block is not a `hero` (`components/page-header.html.twig`: h1, optional ACF `page_lead`, Yoast breadcrumb).
2. **Native editor content**: WordPress `post_content`, output in a `.wysiwyg` wrapper (legal pages, simple editorial content).
3. **ACF flexible blocks**: marketing layouts via `blocks/blocks.html.twig`.

WYSIWYG content and blocks are independent: a page can use either, or both (editorial intro followed by blocks). Block definitions live in `includes/Plugins/ACF/IncludeFields/Layouts/` with matching Twig in `views/blocks/`. Shared fields (layout settings, media, heading level) use the ACF clone library documented in `.cursor/rules/acf-clones.mdc`. See the block list in `.cursor/rules/starter-cinq.mdc`.

### Journal and archives

The blog uses Timber models (`includes/Models/`) mapped in `includes/Setup/Context.php`:

- `Home`: posts index (`home.php`)
- `CategoryArchive`: category archives (`category.php`)
- `TagArchive`: tag archives (`tag.php`)
- `BlogPost`: single post (server-side table of contents, reading time)

Archive editorial content (title, lead, hero) is stored in an **ACF options page** under the Posts menu, not on `page_for_posts`. See `.cursor/rules/archive-options.mdc`. Category and tag filters share `pages/archive-post.html.twig` via the `ArchivePost` trait.

### Search and styleguide

- **Search**: `search.php` renders `pages/search.html.twig`. A dedicated search page can use the `search-page` page template.
- **Styleguide**: the `styleguide-page` template ships a live catalogue of design tokens, shell components, Web Components ([agencecinq/ui](https://agencecinq.github.io/ui/)), and ACF blocks. It loads separate Vite entries (`src/stylesheets/styleguide.css`, `src/scripts/styleguide.ts`). Demo data comes from `includes/Models/StyleguidePage.php`.

### Theme options

Global theme settings (footer menus, social links, …) are managed under **Settings → Theme** (`options-theme` ACF options page). Header navigation uses WordPress nav menus registered by the theme.

### Demo content (seeds)

The `bin/` folder contains WP-CLI seed scripts to populate a local install with demo content (home page blocks, journal posts, flexible page, legal mentions, menus, theme options). Run them from the WordPress web root with ACF active:

```bash
wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-home-page.php --path=/path/to/wordpress/public
wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-archive-post.php --path=/path/to/wordpress/public
wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-flexible-page.php --path=/path/to/wordpress/public
wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-agence-page.php --path=/path/to/wordpress/public
```

`seed-home-page.php` also seeds the agency page, legal mentions page and footer menus. To refresh those pages alone:

```bash
wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-agence-page.php --path=/path/to/wordpress/public
wp eval-file wp-content/themes/wp-cinquante-et-un/bin/seed-legal-page.php --path=/path/to/wordpress/public
```

Shared helpers live in `bin/seed-helpers.php`. Replace the theme slug in the path when working on a renamed project.

### SVG sprite support

Includes built-in support for SVG sprites, allowing you to easily manage and use SVG icons throughout your theme. SVG will be pickup from the `src/icons/` folder and compiled into a single sprite file during the build process. UI icons live on a 24×24 grid with `currentColor` fills and strokes. This file can then be referenced in your Twig templates for efficient icon usage. This file is located in `public/sprite.svg` after build. It is located in the public folder to allow easy access and avoid Vite processing.

The theme provide a Twig component located at `views/svg/use.html.twig` to facilitate the use of SVG icons from the sprite. You can include an icon in your templates like this:

```twig
{{
	include(
		'svg/use.html.twig',
		{
			icon: 'icon-name',
			title: 'Icon Title',
			classes: ['custom-class']
		}
	)
}}
```

The sprite itself is included in the theme's `index.html.twig` file to ensure it's available throughout the site:

```twig
<div id="svg-sprite" style="display: none;">
	{{- include('public/sprite.svg', ignore_missing = true) -}}
</div>
```

### Responsive Images with WebP Support

The theme includes a custom Twig component for rendering responsive images with WebP support. This component automatically generates the necessary `srcset` and `sizes` attributes for optimal image loading across different devices and screen sizes.

You can use the image component in your Twig templates like this:

```twig
{{
	include(
		'components/image.html.twig',
		{
			image: post.thumbnail,
			alt: post.title,
			sizes: '(max-width: 600px) 100vw, 600px',
			classes: ['custom-image-class']
		}
	)
}}
```

It will be rendered as:

```html
<picture>
	<source
		type="image/webp"
		srcset="image-300.webp 300w, image-600.webp 600w, image-900.webp 900w"
		sizes="(max-width: 600px) 100vw, 600px"
	/>
	<img
		class="custom-image-class"
		width="600"
		height="400"
		loading="lazy"
		src="image-600.jpg"
		alt="Post Title"
		srcset="image-300.jpg 300w, image-600.jpg 600w, image-900.jpg 900w"
		sizes="(max-width: 600px) 100vw, 600px"
	/>
</picture>
```

> The only required parameter is `image`, which is an image ID or TimberImage object. Other parameters like `alt`, `sizes`, and `classes` are optional and can be customized as needed. See the comments in the `image.html.twig` file for more details on available parameters.

> The component also handle .svg images by rendering a simple `<img>` tag without `srcset` or `sizes` attributes. It will also skip WebP conversion for SVG images. Gif images are also handled as normal images without WebP conversion and compression.

### Static images support

The theme supports static images located in the `src/img/` directory. You can reference these images directly in your Twig templates thanks to the assets function provided by the Vite class PHP located in `includes/Vite.php`.

It's useful for images that don't require responsive handling or WebP conversion, such as logos or decorative images without losing dev and build mode benefits provided by Vite.

Assets that must survive production deploy without Vite processing (e.g. `public/placeholder.svg`) live directly in `public/` and are referenced with `get_theme_file_uri()` or a plain path. `deploy.sh` keeps `public/` but removes `src/`.

Example of usage in a Twig template:

```twig
<img src="{{ asset('src/img/logo.png') }}" alt="Logo" width="200" height="100" />
```

## Structure

The project structure is organized as follows:

```
wp-cinquante-et-un/
├── .cursor/rules/       # Cursor rules (conventions + init/back-port workflows)
├── .github/workflows/   # CI: release on tag v*
├── bin/                 # WP-CLI seed scripts (demo content)
├── includes/            # PHP classes (PSR-4, namespace WPCinquanteEtUn)
│   ├── Models/          # Timber models (Home, BlogPost, StyleguidePage, …)
│   ├── Plugins/ACF/     # ACF field groups and block layouts
│   ├── Setup/           # Context, Enqueue, Twig bootstrap
│   └── Traits/          # Shared model behaviour (ArchivePost, …)
├── languages/           # i18n (.pot template; translations generated per project)
├── page-templates/      # Named WordPress page templates (styleguide, search)
├── src/                 # Source files for assets
│   ├── stylesheets/     # CSS (theme.css = @theme tokens, styles.css = imports)
│   ├── scripts/         # TypeScript components (mounted via piecesjs)
│   ├── icons/           # SVG icons compiled into public/sprite.svg
│   ├── img/             # Static images (processed by Vite)
│   └── fonts/           # Font files
├── views/               # Twig templates (pages/, blocks/, components/, svg/)
├── public/              # Production assets (sprite.svg, placeholder.svg, …)
├── *.php (root)         # WordPress template hierarchy entry points
├── deploy.sh            # Production build + dev-files purge (used by CI)
├── .env.sample          # Sample environment variables file
├── composer.json        # PHP dependencies
├── package.json         # JavaScript dependencies
├── phpcs.xml            # PHP CodeSniffer configuration (WPCS)
└── vite.config.js       # Vite configuration
```

### PHP CodeSniffer (phpcs.xml)

The `phpcs.xml` file configures **PHP CodeSniffer** (PHPCS) for the theme. It defines the coding style and quality rules applied to the PHP code.

In this theme, the configuration is based on the **WordPress Coding Standards**: indentation, naming, internationalization (text domain `wp-cinquante-et-un`), and more. The `node_modules/`, `vendor/`, and `dist/` directories are excluded from the analysis.

To run the code analysis (after installing PHPCS, e.g. via Composer or globally):

```bash
./vendor/bin/phpcs
```

Or if PHPCS is installed globally:

```bash
phpcs
```

This keeps the theme's PHP code aligned with WordPress standards and project conventions.

### PHP Classes

The PHP classes follow WordPress coding standards and are organized like WordPress core files. For example, the `after_setup_theme` hook is located in `includes/WPSettings.php` because this hook is located in wp-settings.php in WordPress core.

## Installation

Copy the environment template and set your local WordPress URL (used by the Vite dev server for full-page refresh):

```bash
cp .env.sample .env
```

Then edit `.env` and set `APP_URL` to your local site URL, derived from the project slug: `APP_URL = https://<slug>.local` (e.g. `https://wp-cinquante-et-un.local`), without a trailing slash. The Laravel Vite plugin loads these variables automatically.

### PHP Dependencies

Use Composer to install the required PHP dependencies:

```bash
composer install
```

Don't forget to install and activate the required WordPress plugins: **Advanced Custom Fields** and **Classic Editor**. Project plugins (Contact Form 7, Yoast SEO, etc.) are added per site.

### JavaScript Dependencies

Use pnpm to install the required JavaScript dependencies:

```bash
pnpm install
```

### Development Server

To start the development server with Vite, run:

```bash
pnpm dev
```

It will start a local development server and provide a URL to access your site.

### Building for Production

To build the assets for production, run:

```bash
pnpm build
```

### Twig Cache

A fresh WordPress install (including Local) leaves `WP_DEBUG` at `false`. The theme then caches Twig for performance, so template edits will not show until you turn debug on or clear the cache. On `local` and `development` environments, an admin notice reminds you of this.

While developing, set this in `wp-config.php`:

```php
define( 'WP_DEBUG', true );
```

If `WP_DEBUG` stays false, clear the cache after editing a Twig file (`vendor/timber/timber/cache`):

```bash
rm -rf vendor/timber/timber/cache/*
```

### Troubleshooting

- If you encounter issues with Twig templates not updating, ensure you have cleared the cache as described above.
- Make sure all dependencies are installed correctly by running `composer install` and `pnpm install`.
- Check your local environment variables in the `.env` file to ensure they are set up correctly.
- On Local by Flywheel, if `wp eval-file` fails to connect to MySQL with `DB_HOST=localhost`, pass PHP the site socket: `php -d mysqli.default_socket="/path/to/mysqld.sock" $(which wp) eval-file …`.

## Resources

- Twig documentation: [https://twig.symfony.com/doc/](https://twig.symfony.com/doc/)
- Timber documentation: [https://timber.github.io/docs/](https://timber.github.io/docs/)
- Tailwind CSS documentation: [https://tailwindcss.com/docs](https://tailwindcss.com/docs)
- WordPress Theme Development: [https://developer.wordpress.org/themes/](https://developer.wordpress.org/themes/)
- Vite documentation: [https://vitejs.dev/](https://vitejs.dev/)
- ACF documentation: [https://www.advancedcustomfields.com/resources/](https://www.advancedcustomfields.com/resources/)

## Contributing

Contributions are welcome! If you find a bug or have a feature request, please open an issue or submit a pull request.

## License

This theme is licensed under the GNU General Public License v2 or later, like WordPress. See the [LICENSE](LICENSE) file for details.
