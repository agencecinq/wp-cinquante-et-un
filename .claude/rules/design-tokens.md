---
paths:
  - "src/stylesheets/**/*.css"
  - "includes/schemes.php"
  - "**/*.twig"
---

# Design tokens

## Colors: Figma roles, in the Tailwind namespace of their group

Templates paint with **roles** only. The Figma group picks the Tailwind namespace:

| Figma (collection Couleurs) | CSS property | Class |
| --- | --- | --- |
| `text/primary`, `text/secondary`, `text/inverse`, `text/accent-inverse`, `text/error`, `text/success` | `--text-color-*` | `text-primary`, `text-secondary`… |
| `bg/page`, `bg/surface`, `bg/white`, `bg/inverse`, `bg/media`, `bg/accent` | `--background-color-*` | `bg-page`, `bg-surface`… |
| `border/default`, `border/field`, `border/inverse`, `border/error` | `--border-color-*` | `border-default`, `divide-field`… |
| `button/primary-bg`, `button/primary-bg-hover` | `--background-color-button-primary(-hover)` | `bg-button-primary`… |
| `button/primary-text`, `button/primary-text-hover` | `--text-color-button-primary(-hover)` | `text-button-primary`… |
| `icon/default`, `icon/inverse`, `accent`, `ornament`, `focus/ring`, `focus/ring-inverse`, `overlay/scrim` | `--color-*` | `text-icon`, `fill-icon`, `outline-focus-ring`, `bg-overlay-scrim/50` |

- Values live in `includes/schemes.php`: primitives `cinq_palette()`, roles `cinq_scheme_roles()`, schemes `cinq_schemes()`, printed in the `<head>` by `cinq_colors_css()`. `theme.css` only declares the names (`@theme reference`, `--color-*: initial`): the Tailwind palette (`bg-white`, `text-gray-500`, `border-black`) no longer exists.
- The CSS property is also the **code syntax** of the Figma variable (`var(--text-color-primary)`); primitives are `var(--palette-*)` and never classes.
- Schemes are Figma modes: `''` (Clair, the default) and `dark` (Sombre). `surface` and `white` are Clair sections painted with `bg/surface` or `bg/white`. A block sets `data-scheme` from its ACF `color_scheme`; `[data-scheme]` paints its background and text, every role inside follows. `*-inverse` roles are for an element inverted within its section.
- The starter values are a wireframe (ink `#2a343a` and grays). A project replaces the values with its Figma variables; role names stay.
- A role that paints another property than its own goes through the variable: `before:bg-(--border-color-default)`.
- Prefer a role to an opacity (`text-secondary`, not `text-primary/60`).
- Never `bg-[#2a343a]`, never a gradient or color in an arbitrary value.

## Token names in English

All custom property **suffixes** in `@theme` and `schemes.php` must be in **English**, kebab-case (`--color-accent`, not `--color-vert`). Never add French token names.

## No preset section backgrounds in the starter

The starter must not ship decorative section backgrounds (gradients, branded fills) in Twig templates. Background colors and images are chosen per project via tokens and block content, not baked into layout shells.

## Sizes in `rem` (no `px` in utilities)

All dimensional values in Tailwind classes and CSS must use **rem** or the **spacing scale** (`--spacing`), never **px** arbitrary values.

Applies to: `font-size`, `width`, `height`, `gap`, `padding`, `margin`, `inset`, etc.

- **Prefer spacing utilities** when the design value maps to the scale: `w-11.5` (46px), `gap-6.5` (26px), `py-3.5` (14px), `max-w-105` (420px / 26.25rem), not `w-[46px]`, `gap-[26px]`, or `max-w-[26.25rem]`.
- **Tailwind arbitrary values in Twig**: last resort only when no scale utility exists. Never use `[…rem]` or `[…px]` if the linter or IntelliSense proposes an equivalent scale class (e.g. `max-w-[26.25rem]` → `max-w-105`).
- **`@theme` tokens** (`--text-*`, `--width-*`, etc.): declare in rem, not px.
- **CSS** (`base/`, `utilities/`, legacy `components/`): dimensional properties in rem or `calc(var(--spacing) * n)`.

Conversion reference: `rem = px / 16` (e.g. `46px` → `2.875rem` or `w-11.5`, `26px` → `1.625rem` or `gap-6.5`).

**Exceptions:** `border-width` utilities (`border-2`), box-shadow offsets in `@theme` (`--shadow-brutal-sm`), and HTML `width`/`height` attributes on `<img>` (intrinsic dimensions).

If a value is reused, add a token in `@theme` rather than repeating rem arbitrary values in Twig.

## Letter-spacing in `em`

All `letter-spacing` values must be expressed in **em**, never in **px**.

- **`@theme` typography tokens** (`--text-*--letter-spacing`, or dedicated tokens): declare in em (`0.025em`, not `0.5px`).
- **Tailwind classes in Twig**: `tracking-[0.0227em]`, never `tracking-[0.5px]` or `tracking-wide` when a precise design value is required (utility presets are acceptable for generic typography classes).
- **CSS**: `letter-spacing` in em only.

Conversion reference: `em = px / font-size-px` on the same element (e.g. `0.5px` at `22px` / `1.375rem` → `0.0227em`).

If a value is reused, add a token in `@theme` rather than repeating em arbitrary values in Twig.

## Typography (Tailwind scale)

Use Tailwind type utilities in Twig: `text-xs` … `text-6xl`, plus `font-medium`, `font-semibold`, and `font-bold` (prose only). Do not invent composite classes (`title-xl`, `eyebrow`) except `.subtitle` and `.prose-*`.

- **Titles**: size + `font-semibold` (e.g. `text-4xl font-semibold`). Display 5xl/6xl is editorial (heroes).
- **Text**: `text-xs` … `text-lg`.
- **Meta / overline**: `.subtitle` (`text-xs font-medium uppercase`, letter-spacing 0.1em).
- **Article body**: `.prose-base` / `.prose-lg` (line-height 1.7). Never mix with Body UI styles.

The starter ships no custom typeface: system sans-serif stack via `--default-font-family`. On the project, self-host the fonts (Google Fonts included) with `@font-face` in `font-face.css`, list the above-the-fold files in `Enqueue::PRELOAD_FONTS` and update `--font-sans` (see `init-nouveau-projet`).

Container: `--container-max-width` (90rem = 1440px, or 110rem = 1760px). Editorial measure: `--max-width-prose` (45rem = 720px) via `max-w-prose`. Easing: `--ease-out`, `--ease-in-out`, `--ease-drawer` (`ease-drawer`).

## Checklist when adding a token

1. In Figma first (variable + code syntax), then under the same English kebab-case name in `@theme` or `schemes.php`.
2. Used via a utility class in Twig/CSS, not an arbitrary value.
3. Sizes in rem or spacing scale, letter-spacing in em (see above).
4. Added to the styleguide (`views/components/styleguide.html.twig`).
5. `pnpm build` passes.
