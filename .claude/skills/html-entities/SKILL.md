---
name: html-entities
description: >-
  Prefer named HTML entities over raw Unicode special characters in UI copy
  (Twig, PHP i18n strings, seed content). Apply when writing or editing
  user-facing strings in CINQ WordPress themes (starter or client projects).
---

# HTML entities

## Hard rule

Use **named HTML entities** in user-facing strings (Twig, `__()` / `_e()` / related i18n helpers, seed HTML).

Do not paste invisible Unicode (NBSP `U+00A0`, ellipsis `…`) or typewriter shortcuts that look like normal spaces in the editor.

## Preferred entities

| Need | Entity | Avoid |
| --- | --- | --- |
| Non-breaking space | `&nbsp;` | Literal NBSP, `\u00a0`, `"\xa0"` |
| Ellipsis | `&hellip;` | `...`, `…` |
| Apostrophe / right single quote (FR typography) | `&rsquo;` | Word-processor curly `'` |

French copy: put `&nbsp;` before `:`, `;`, `!`, `?`, `%`, and between a number and its unit or symbol (`1,8&nbsp;s`, `%s&nbsp;€`).

## Twig

When a trusted theme string contains entities and must render them:

```twig
{{- __('%s&nbsp;€', 'text-domain') | format(amount) | raw -}}
```

Use `| raw` only on trusted theme i18n strings, never on user input.

Reference in the starter: `bin/seed-helpers.php` (NBSP before `:` and before units).

## DONT

- No emoji in authored copy.
- No em dash / tiret cadratin (`—` or `&mdash;`) in authored copy.
- No literal NBSP characters that look like regular spaces in source.
