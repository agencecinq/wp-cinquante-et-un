# feat/blockstudio — experiment notes

Branch exploring [Blockstudio](https://blockstudio.dev/) as an alternative to ACF Flexible Content for page blocks, while keeping Timber + Twig and the existing Vite/Tailwind pipeline.

## Status

Pilot only. Not ready to replace the ACF kernel.

| Kept | Changed |
| --- | --- |
| Timber / Twig | Gutenberg required for Blockstudio blocks |
| Vite + Tailwind in `src/` (header/footer, ACF layouts) | Classic Editor no longer required on this branch |
| ACF flexible layouts (dual-run) | `post_content` renders Gutenberg / Blockstudio blocks |
| Theme helpers (`cinq_block_*`) | Three pilot blocks: Hero, CTA, FAQ (accordion-group) |
|  | Blockstudio Tailwind on (`blockstudio.json`): frontend TailwindPHP + editor CDN ([docs](https://blockstudio.dev/docs/tailwind/)); tokens via `Setup/Blockstudio.php` |
|  | FAQ pilot uses `@agencecinq/accordion` (vendored + editor iframe inject) so panels work in Gutenberg |

## Install

```bash
composer install
```

Blockstudio is bundled in the theme (`composer require blockstudio/blockstudio`). Autoload via `functions.php` boots it; no separate plugin activation.

Deactivate **Classic Editor** on the local site so the block editor is available for pages.

## Pilot blocks

```
blockstudio/
  hero/              → wp-cinquante-et-un/hero
  cta/               → wp-cinquante-et-un/cta
  accordion-group/   → wp-cinquante-et-un/accordion-group (@agencecinq/accordion)
```

Edit a page in Gutenberg, insert **Hero**, **CTA**, or **FAQ**, save, view front.

The FAQ block vendors `@agencecinq/accordion` and injects it into the Gutenberg iframe via `Setup/Blockstudio.php` (relative ES imports break when Blockstudio inlines editor scripts). Frontend keeps using Vite (`app.js`). The ACF twin still uses native `details`/`summary`.

ACF flexible content still renders below `post_content` so existing seeded pages keep working.

## What this does not cover yet

- Migrating the remaining ACF layouts
- Shared field clones (layout / media / heading)
- Archive options pages
- Content migration from ACF meta → block markup
- Seeds for Blockstudio pages
- Cursor rules / starter DO-DONT flip (still document ACF + Classic Editor as the mainline)

## Next steps if the pilot lands

1. Shared Blockstudio custom fields for layout tokens
2. Port MediaText / RichText / Cta-class blocks one by one
3. Drop dual-run ACF once content path is chosen
4. Update `.cursor/rules` and README as the new default
