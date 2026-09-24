---
name: tailwind-pseudo-content
description: >-
  Prefer CSS pseudo-elements (before:/after:) over empty decorative HTML tags
  when possible. Do not add before:content-[''] or after:content-[''] when other
  before:*/after:* utilities are already present — Tailwind v3.4+ / v4 sets empty
  content automatically. Apply when writing or editing Twig/Tailwind in CINQ themes.
---

# Tailwind: prefer pseudos, no redundant `content-['']`

## Prefer a pseudo over an empty HTML tag

When an element is **purely decorative** (scrim, divider, line, overlay, bullet
separator) and carries no content, semantics, or interactivity, prefer
`before:` / `after:` on the parent instead of an empty `<div>`, `<span>`, etc.

```twig
{# DO — overlay as ::after #}
<div class="absolute inset-0 after:absolute after:inset-0 after:bg-hero-overlay">
  {{ include('components/image.html.twig', { … }) }}
</div>

{# DONT — empty decorative tag #}
<div class="absolute inset-0">
  {{ include('components/image.html.twig', { … }) }}
  <div class="absolute inset-0 bg-hero-overlay" aria-hidden="true"></div>
</div>
```

```twig
{# DO — list separator as ::before #}
<li class="flex items-center gap-3.75 before:block before:h-3.5 before:w-px before:bg-ink first:before:hidden">

{# DONT #}
<li class="flex items-center gap-3.75">
  {%- if not loop.first -%}
    <span class="block h-3.5 w-px bg-ink" aria-hidden="true"></span>
  {%- endif -%}
```

**Keep a real tag** when the node needs semantics, focus, a link, an image,
accessible text, or when a pseudo cannot express the layout (e.g. several
independent layers that each need their own stacking context beyond one
`::before` / `::after`).

Use `::after` when the decoration must paint **above** existing children
(e.g. image + scrim); `::before` when it should sit behind or act as a
leading separator.

## No redundant `content-['']`

When an element already has any `before:*` or `after:*` utility, **do not** add
`before:content-['']` or `after:content-['']`. Tailwind sets `content: ""` on
those variants by default.

```twig
{# DO #}
<div class="after:absolute after:inset-0 after:bg-hero-overlay">

{# DONT — redundant, remove on sight #}
<div class="after:absolute after:inset-0 after:bg-hero-overlay after:content-['']">
```

## When `content-*` is allowed

Only to set a **non-empty** value on the pseudo (`before:content-['→']`,
`after:content-[attr(data-label)]`, etc.).

## Scope

Applies to every `.twig` (and Tailwind markup) in CINQ themes: starter and
client copies. Same rule as `.cursor/rules/tailwind-twig.mdc` — this skill
exists so the agent does not keep regressing.
