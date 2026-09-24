---
name: timber-twig
description: >-
  Timber 2 Twig conventions for CINQ WordPress themes (built-in get_posts /
  get_post, excerpts, PostExcerpt API). Use when writing or editing Twig that
  queries posts, shows excerpts/teasers/chapôs, or when fixing Timber
  deprecation notices about post.preview.
---

# Timber 2 Twig (CINQ)

Always follow the official [Timber v2 documentation](https://timber.github.io/docs/v2/) and the project rule `timber-twig`.

## Built-in content functions

Timber registers retrieval helpers in Twig — **do not** call them via `function('Timber\\Timber::get_posts', …)` or `fn(...)`.

Docs: [Functions](https://timber.github.io/docs/v2/guides/functions/), [Posts](https://timber.github.io/docs/v2/guides/posts/).

```twig
{# Query (WP_Query args) — preferred #}
{% set posts = get_posts({
	post_type: 'sector',
	posts_per_page: -1,
	post_status: 'publish',
	orderby: {
		menu_order: 'ASC',
		title: 'ASC'
	}
}) %}

{% for post in posts %}
	{{ post.title }}
{% endfor %}

{# From IDs #}
{% set posts = get_posts(post_ids) %}
{% set post = get_post(post_id) %}
```

Same family (use when needed): `get_image`, `get_attachment`, `get_term`, `get_terms`, `get_user`, `get_users`, `get_comment`, `get_comments`.

Reserve `function()` / `fn()` for PHP that is **not** a Timber built-in (`wp_head`, custom helpers, …).

`{% set %}` for a `get_posts` result is fine when the collection is reused (guard + loop).

## Excerpts

`{{ post.preview }}` is **removed in practice** (deprecated since Timber 2.0). Use `{{ post.excerpt }}`.

```twig
{# Preferred: hash options — https://timber.github.io/docs/v2/reference/timber-postexcerpt/ #}
{{ post.excerpt({ words: 40, read_more: false }) }}

{# Chainable #}
{{ post.excerpt.length(40).read_more(false) }}

{# Manual WP excerpt with generated fallback #}
{{ post.post_excerpt | default(post.excerpt({ words: 40, read_more: false }) | striptags) | trim }}
```

- `read_more: false` disables the link (do not use `''`).
- If a deprecation for `post.preview` appears after a Twig change with `WP_DEBUG` false, clear `vendor/timber/timber/cache/*`.
