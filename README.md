# WP CINQ – WordPress Theme

The **WP CINQ** theme is a custom WordPress theme built on top of Timber/Twig and the internal **WP CINQ** starter.  
It is tailored for the WP CINQ website and provides a modern, performant and maintainable foundation for integrating the project’s design and custom features.

## Key features

- **Timber & Twig**: clean, reusable template components.
- **Modern tooling**: Composer, pnpm and Vite for bundling and hot‑reload.
- **Accessibility**: semantic HTML, clear structure, ARIA best practices where relevant.
- **Performance**: optimized images (WebP, lazy‑loading), SVG sprite, minified assets in production.
- **Extensibility**: class‑based PHP in `includes/`, Twig components in `views/`, front‑end sources in `src/`.

### SVG sprite support

Includes built-in support for SVG sprites, allowing you to easily manage and use SVG icons throughout your theme. SVG will be pickup from the `src/icons/` folder and compiled into a single sprite file during the build process. This file can then be referenced in your Twig templates for efficient icon usage. This file is located in `public/sprite.svg` after build. It is located in the public folder to allow easy access and avoid Vite processing.

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
<div style="display: none;">
	{{ include 'svg/sprite.html.twig' }}
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

Example of usage in a Twig template:

```twig
<img src="{{ assets('src/img/logo.png') }}" alt="Logo" width="200" height="100" />
```

## Structure

The project structure is organized as follows:

```
wp-cinquante-et-un/
├── includes/            # PHP classes and functions
├── src/                 # Source files for assets
│   ├── stylesheets/     # CSS files
│   ├── scripts/         # JavaScript files
│   ├── icons/           # SVG icons for sprite
│   ├── img/             # Static images
|   └── fonts/           # Font files
├── views/               # Twig templates
├── public/              # Compiled assets and theme files
├── .env.sample          # Sample environment variables file
├── composer.json        # PHP dependencies
├── package.json         # JavaScript dependencies
├── phpcs.xml            # PHP CodeSniffer configuration
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

Add your local environment variables in a `.env` file. Use `.env.sample` as a template. Laravel's Vite plugin will load the variables automatically.

### PHP Dependencies

Use Composer to install the required PHP dependencies:

```bash
composer install
```

Don't forget to install and activate the required WordPress plugins, such as ACF, to ensure full functionality of the theme.

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

When the WP_DEBUG constant is set to false (which is the default in production environments), Twig files are cached for performance. If you modify any Twig files, you need to clear the cache to see the changes. The cache folder is located at `vendor/timber/timber/cache`.

To clear the cache, simply delete the contents of the `cache` folder or run the following command:

```bash
rm -rf vendor/timber/timber/cache/*
```

### Troubleshooting

- If you encounter issues with Twig templates not updating, ensure you have cleared the cache as described above.
- Make sure all dependencies are installed correctly by running `composer install` and `pnpm install`.
- Check your local environment variables in the `.env` file to ensure they are set up correctly.

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

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
