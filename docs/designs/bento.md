# Design system · C "Bento"

## Concept and mood

Every page is a **bento box**: a 12-column grid of rounded cards of different sizes, each holding one idea
(who I am, what I'm doing now, a figure, a list). The mood is friendly, product-like and confident: soft grey
canvas, white cards with hairline borders, heavy Plus Jakarta Sans headlines with tight tracking, monospace
eyebrow labels, and a single **violet** accent used for actions, the current state and a few highlighted words.
One dark "inverse" card and one violet card per page add rhythm. In the dark theme the canvas goes near-black,
cards lift slightly, and the violet becomes a light lavender.

The header is a floating pill bar; the current page is a filled pill. On small screens the grid collapses to
one column (two columns between 700 and 860 px), and the navigation moves into a panel behind a menu button.

Files: everything lives in `resources/js/designs/bento/`, organised by Feature-Sliced Design (see
[docs/frontend.md](../frontend.md)). The logic shared by every design (dates, navigation, theme, portfolio filter,
profile helpers and entity types) comes from `resources/js/core/`; this folder holds the Bento UI and its styles.

| Path | Holds |
| --- | --- |
| `app/styles/index.css` | The entry stylesheet: fonts, `tokens.css`, `base.css`, then each slice's stylesheet in cascade order |
| `app/styles/tokens.css` | Primitive and semantic tokens, light and dark |
| `app/styles/base.css` | Element defaults, `.wrap`, focus ring, skip link, `.visually-hidden`, reduced motion |
| `*/ui/*.css` | Component styles, next to the slice that renders them (global CSS, no `<style>` blocks) |
| `app/`, `pages/`, `widgets/`, `features/`, `entities/`, `shared/` | Vue components and their models (below) |

## Structure

```
resources/js/designs/bento/
  app/
    index.ts                      exports the site Layout
    layout/SiteLayout.vue         skip link, header, <main>, footer (+ site-layout.css)
    styles/                       index.css (entry), tokens.css, base.css
  pages/
    about/                        About.vue; model: props type (education, award, stack), headline split, status lines
    experience/                   Experience.vue; model: props type, course score label, certificate issuers
    portfolio/                    Portfolio.vue: core usePortfolioFilter, live-region status, project grid
    soft-skills/                  SoftSkills.vue; model: icon per skill, tile spans
    hobbies/                      Hobbies.vue; model: lead photo and card layouts
  widgets/
    site-header/                  pill bar: brand, primary navigation, theme toggle, mobile menu
    site-footer/                  copyright and profile links
    contact-tile/                 violet call-to-action card
    work-history/                 the Experience "Work" tile; model: current-role entry, positions newest first
    project-grid/                 bento list of project cards; model: sizesFor (card sizes), card kinds
  features/
    theme-toggle/                 light/dark IconButton on core useTheme
    portfolio-filter/             category toggle buttons; model: the live-region text
  entities/
    profile/                      BentoProfile type, useProfile (core's, with contact wording and icon)
    project/                      ProjectCard; model: monogram
    work/                         TimelineEntry
    language/                     LanguageMeter; model: language level in words
  shared/
    ui/                           Icon (+ icon set), IconButton, BaseButton, BentoGrid, BentoTile, TileLabel,
                                  TileHeading, PageIntro, ChipList, and the grid, text, chip and mini-card styles
```

## Tokens

Two layers. **Primitives** (`--p-*`) are the raw palette and font stacks and are never used by components.
**Semantic tokens** are what components use; themes only re-map them. Dark values live under
`:root[data-theme="dark"]` and, when the visitor hasn't chosen, under
`@media (prefers-color-scheme: dark) { :root:not([data-theme="light"]) }`.

### Colour

| Token | Role | Light | Dark |
| --- | --- | --- | --- |
| `--color-bg` | Page canvas | `#F1F2F6` mist-100 | `#0C0D11` ink-950 |
| `--color-surface` | Cards, header bar | `#FFFFFF` | `#16181F` ink-850 |
| `--color-surface-sunken` | Cards inside cards, chips, meter track | `#F1F2F6` | `#0C0D11` |
| `--color-text` | Body text, headings | `#14161C` ink-900 | `#EDEEF2` mist-150 |
| `--color-text-muted` | Secondary text, labels | `#4F5666` slate-600 | `#A6ABB8` slate-400 |
| `--color-border` | Hairline card borders (decorative) | `#E3E5EC` | `#262935` |
| `--color-accent` | Primary buttons, links, highlights, meters | `#6D28D9` violet-700 | `#B79CFF` violet-300 |
| `--color-on-accent` | Text on accent | `#FFFFFF` | `#14161C` |
| `--color-accent-soft` | Status pill, icon tiles, monogram panels | `#F1EAFE` violet-50 | `#231C3A` violet-950 |
| `--color-inverse` | Inverse card, current nav pill | `#14161C` | `#EDEEF2` |
| `--color-on-inverse` | Text on inverse | `#FFFFFF` | `#14161C` |
| `--color-inverse-muted` | Secondary text on inverse | `#C2C6D1` | `#3D4250` |
| `--color-focus` | Focus ring | `#6D28D9` | `#B79CFF` |

Contrast of the pairs in use (WCAG 2.2 AA needs 4.5:1 for text, 3:1 for UI parts):

| Pair | Light | Dark |
| --- | --- | --- |
| text / surface | 18.08 | 15.29 |
| text / bg (and sunken) | 16.16 | 16.75 |
| text-muted / surface | 7.35 | 7.71 |
| text-muted / bg | 6.57 | 8.45 |
| accent / surface (links, dates) | 7.10 | 7.78 |
| accent / bg (meter on track) | 6.35 | 8.52 |
| on-accent / accent | 7.10 | 7.93 |
| text / accent-soft | 15.45 | 13.95 |
| accent / accent-soft (icons, monograms) | 6.07 | 7.09 |
| on-inverse / inverse | 18.08 | 15.60 |
| inverse-muted / inverse | 10.59 | 8.65 |

The focus ring is the accent (≥ 6:1 against both canvases). On accent and inverse surfaces, `.tone-accent` and
`.tone-inverse` swap `--color-focus` to the on-colour, because the accent would be too close to those
backgrounds (2.55:1 on the light inverse card, 1.97:1 on the dark one).

### Typography

Fonts: **Plus Jakarta Sans** (variable, 200–800, self-hosted from `@fontsource-variable/plus-jakarta-sans`) for
everything, and **Geist Mono** 500 (`@fontsource/geist-mono`, latin subset only) for eyebrow labels, dates and
counts. No CDN.

| Token | Size | Use |
| --- | --- | --- |
| `--text-2xs` | 12px | Card kicker (project category), badges |
| `--text-xs` | 13px | Mono labels, small chips, dates |
| `--text-sm` | 14px | Chips, status pill, filter buttons |
| `--text-md` | 15px | Navigation, secondary copy |
| `--text-base` | 17px | Body |
| `--text-lg` | 19px (17 on small screens) | Lead paragraphs, brand |
| `--text-xl` | 22px | Card titles |
| `--text-2xl` | 28px | Section titles |
| `--text-3xl` | 34px (26) | Featured project title, call-to-action |
| `--text-figure` | 56px (44) | Big numbers |
| `--text-display` | 60px (40) | Page `<h1>` |
| `--text-monogram` / `-lg` | 40px / 96px (64) | Project monograms |

Weights: `--weight-regular` 400, `--weight-semibold` 600, `--weight-bold` 700, `--weight-heavy` 800,
`--weight-mono` 500. Line heights: `--leading-tight` 1.02 (display), `--leading-snug` 1.15, `--leading-normal`
1.6. Tracking: `--tracking-display` −0.03em, `--tracking-heading` −0.02em, `--tracking-title` −0.01em,
`--tracking-label` +0.06em (uppercase mono).

### Spacing and layout

4px base: `--space-1` 4, `--space-1-5` 6, `--space-2` 8, `--space-2-5` 10, `--space-3` 12, `--space-3-5` 14,
`--space-4` 16, `--space-4-5` 18, `--space-5` 20, `--space-5-5` 22, `--space-6` 24, `--space-6-5` 26,
`--space-7` 28, `--space-8` 32, `--space-10` 40, `--space-12` 48, `--space-16` 64 (`--space-0-5` 3 for badges).

| Token | Wide | ≤ 700px |
| --- | --- | --- |
| `--gutter` | 32px | 16px |
| `--grid-gap` | 16px | 12px |
| `--tile-padding` | 28px | 22px |
| `--tile-padding-lg` | 40px | 22px |
| `--content-max` | 1180px | — |

Sizes: `--target-min` 24px, `--target-primary` 44px, `--target-cta` 52px, plus component sizes
(`--size-avatar`, `--size-icon-tile`, `--size-art`, `--size-media`, …) in `tokens.css`.

### Radius, elevation, motion

| Token | Value |
| --- | --- |
| `--radius-sm` | 14px (list rows, small links) |
| `--radius-md` | 20px (cards inside cards) |
| `--radius-lg` | 28px, 24px on small screens (tiles) |
| `--radius-icon` / `--radius-avatar` | 16px / 22px |
| `--radius-pill` | 999px (buttons, chips, header) |
| `--shadow-raised` | Only the mobile menu panel; tiles are flat with a hairline border |
| `--duration-fast` / `--duration-base` | 120ms / 200ms |
| `--ease-standard` | `cubic-bezier(0.2, 0, 0, 1)` |
| `--lift` | −2px hover lift for buttons and project cards |

All transitions are switched off under `prefers-reduced-motion: reduce` (in `base.css`).

## Components

Each component lives in the slice named in the table (see Structure). None touches `window`, `document` or `localStorage` outside
`onMounted` or event handlers, so they render on the server.

| Component | Props | Notes |
| --- | --- | --- |
| `SiteHeader` (widgets/site-header) | — | Pill bar: brand, `<nav aria-label="Primary">`, `ThemeToggle`, menu button (≤ 900px). Uses core `useSiteMenu`. Escape closes the menu and returns focus to the button. |
| `SiteFooter` (widgets/site-footer) | — | Copyright and round links to the configured GitHub / LinkedIn / email. |
| `ThemeToggle` (features/theme-toggle) | — | `IconButton` with `aria-pressed` (pressed = dark theme), uses core `useTheme`. |
| `IconButton` (shared/ui) | `icon`, `label` (required), `href`, `pressed`, `expanded`, `controls` | 44×44 round button or link. External links add "(opens in a new tab)" to the label. |
| `Icon` (shared/ui) | `name` (`IconName`, from `icons.ts`), `size` | Decorative inline SVG, always `aria-hidden`. |
| `BaseButton` (shared/ui) | `href`, `variant` (`primary` · `ghost` · `on-accent`), `type` | 52px pill. Internal paths → Inertia `<Link>`, external → `<a target="_blank">` with hidden "(opens in a new tab)", none → `<button>`. |
| `BentoGrid` (shared/ui) | `as` | 12-column grid; `as="ul"` for lists. |
| `BentoTile` (shared/ui) | `as`, `span` (4,5,6,7,8,12), `rows` (1,2), `tone` (`surface` · `inverse` · `accent` · `dashed`), `padding` (`none` · `md` · `lg`) | The card. Pass `aria-labelledby` for sections. |
| `TileLabel` (shared/ui) | `as` | Mono uppercase eyebrow; use `as="h2"` when it is the tile's heading. |
| `TileHeading` (shared/ui) | `id`, `level`, `meta` | Section title with right-aligned mono meta. |
| `PageIntro` (shared/ui) | `title`, `label`, `lead`, `span`, `as` | Header tile holding the page's only `<h1>`. |
| `ChipList` (shared/ui) | `items`, `label`, `size` (`sm` · `md`), `surface` (`sunken` · `raised`), `limit` | With `limit`, a "+n more" button (`aria-expanded`) reveals the rest. |
| `LanguageMeter` (entities/language) | `name`, `level`, `rating`, `max` | List item; the bar is `role="img"` "x out of 5" and the level is also written out. |
| `TimelineEntry` (entities/work) | `title`, `period`, `organisation`, `html`, `tags`, `current` | Work entry (`<li>` in an `<ol>`). `html` is the owner's rich text. "Current" is a text badge. |
| `PortfolioFilter` (features/portfolio-filter) | `options` (core `FilterOption[]`), `label`, `v-model` | `role="group"` of toggle buttons with `aria-pressed`; the pressed one also shows a check mark. The state comes from core `usePortfolioFilter`; `filterStatus` words the live region. |
| `ProjectCard` (entities/project) | `project`, `kind`, `size` (`wide` · `half` · `third` · `full`), `featured`, `inverseArt` | Monogram panel (cover image on the featured card, falling back to the monogram if it fails). Long descriptions are clamped to 4 lines with a "Read more" toggle. |
| `ContactTile` (widgets/contact-tile) | `title`, `span`, `headingId` | Violet call to action; links to email, else LinkedIn, else GitHub; hidden when none is set. |
| `WorkHistory` (widgets/work-history) | `companies` | The Experience "Work" tile: the configured current role (when no position is current), then every position newest first. |
| `ProjectGrid` (widgets/project-grid) | `projects` (core `ProjectInCategory[]`) | `<ul class="bento">` of `ProjectCard`s; `sizesFor` picks sizes so every row is full, the first of three or more is featured. |

Logic from core: `useTheme` (`@core/features/theme`), `useSiteMenu` (`@core/features/site-menu`),
`usePortfolioFilter` (`@core/features/portfolio-filter`), `useProfile` and `contactLink`
(`@core/entities/profile`, wrapped by `entities/profile` to add Bento's wording: "Get in touch", "Get in touch on
LinkedIn", "Find me on GitHub", with a mail, LinkedIn or GitHub icon) and the date and text helpers of
`@core/shared/lib` (`formatYear`, `formatPeriod`, `findOrdinal`, `pad2`).

Usage:

```vue
<BentoGrid>
    <PageIntro label="Hobbies" title="Off the clock" lead="What I do when the laptop is closed." :span="5" />
    <BentoTile :span="7" tone="inverse" aria-labelledby="award-title">
        <TileLabel as="h2" id="award-title">Award · 2019</TileLabel>
        <p class="figure">2nd</p>
    </BentoTile>
</BentoGrid>
```

Helper classes: `.display`, `.lead`, `.muted`, `.figure`, `.accent-text`, `.tile-title`, `.go` (arrow link),
`.mini-grid` / `.mini-card` (sunken cards inside a tile), `.visually-hidden`.

## Content and data

- Everything shown comes from the page props or from `config/designs.php` (`designs.bento.profile`, merged over `config/profile.php`).
- Home page copy without a data source is in the profile config: `headline` (`PROFILE_HEADLINE`, the last word
  takes the accent colour) and `bio` (`PROFILE_BIO`); the defaults come from the previous About page.
- The education card's big figure is `education_score` (`PROFILE_EDUCATION_SCORE`, e.g. `95%`); when empty it
  shows the graduation year. The award figure is the ordinal in the award title ("2nd"), else the year.
- "Most-used stack" lists the tags used most across work positions and portfolio projects (About `stack` prop).
- The Experience "current role" entry comes from `profile.current_role` when no position in the database is
  marked current.

## Accessibility notes

- One `<h1>` per page (the About h1 also carries the name in visually hidden text); headings go h1 → h2 → h3;
  sections use `aria-labelledby`.
- Landmarks: header, `nav aria-label="Primary"`, `main#main` (skip link target), footer.
- Current page: `aria-current="page"` plus a filled, bolder pill.
- Focus: 3px ring with 3px offset everywhere, recoloured on accent and inverse surfaces.
- Targets: nav, icon buttons and filters are 44px, call-to-action buttons 52px, chip toggles and "Read more"
  at least 24px.
- Portfolio filter: toggle buttons with `aria-pressed` and a check icon, counts in visible text and as
  "(n projects)" for screen readers, and a `role="status"` polite live region announcing "Showing n projects…".
- State is never colour alone: pressed filters show a check, the current role has a "Current" text badge,
  language levels are written out next to the meters.
- External links announce that they open a new tab. Images have alt text; photos beside their own title are
  decorative (`alt=""`).
- `prefers-reduced-motion` disables the hover lifts and transitions.
