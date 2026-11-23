---
paths:
  - "views/**/*.twig"
  - ".prettierrc.json"
---

# Twig et WordPress Coding Standards

## Principe

Les templates Twig suivent le même style que le PHP WPCS, appliqué par Prettier avec le fork agence du plugin Twig : [`@agencecinq/prettier-plugin-twig`](https://github.com/agencecinq/prettier-plugin-twig), installé sous le nom `@zackad/prettier-plugin-twig` (`package.json` : `"github:agencecinq/prettier-plugin-twig#v1.2.1"`).

Son option `twigFollowWordPressCodingStandards` est active par défaut : rien à régler dans `.prettierrc.json`. L'ancienne option `twigFollowOfficialCodingStandards: false` du plugin upstream n'existe plus.

## Ce que Prettier écrit

- Espaces à l'intérieur des parenthèses d'appels, filtres et tests, sauf vides : `default( 'h2' )`, `foo()`.
- Espaces dans les parenthèses de regroupement et les séquences : `( a or b )`, `[ 1, 2 ]`, `[]`.
- Espaces autour de `|` et dans les interpolations : `name | upper`, `"#{ name }"`.
- Une propriété de mapping reste sur une ligne ; plusieurs vont chacune sur la leur, avec une virgule après la dernière.
- Arguments nommés en `:` : `with_context: false`.
- Le ternaire teste le cas vrai : `active ? 'on' : 'off'`.

```twig
{{ post.title | default( 'Untitled' ) }}
{%- if not post.password_required and ( is_single or is_page ) -%}
{{- include( 'components/button.html.twig', link, with_context: false ) -}}
```

## DO

- Laisser Prettier formater les `.twig` au save (`.vscode/settings.json`) et lancer `pnpm format` avant de pousser : la CI lance `pnpm format:check`.
- Écrire un élément entier dans un même template. Un tag ouvert dans une branche et fermé dans une autre (`{% if %}<a …>{% else %}<div …>{% endif %}`) ne se parse pas : utiliser un nom de tag dynamique (`<{{ url ? 'a' : 'div' }}>`), comme `components/button.html.twig`.
- Un attribut conditionnel passe par `html_attr()` (`{{ html_attr( { hidden: not loop.first } ) }}`), pas par un `{% if %}` dans la balise.

## DONT

- Pas de format compact Twig officiel (`foo|bar('x')`) : il est réécrit au save.
- Pas de `.twig` exclu de Prettier pour garder un formatage manuel : seul un template qui ouvre un élément fermé par un autre template va dans `.prettierignore`, avec la raison en commentaire.
