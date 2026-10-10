# Design system: Terrain

Terrain is the visual language of the public site (About, Experience, Portfolio, Soft skills, Hobbies). This page
covers the concept, the tokens, the fonts, the Vue components and the accessibility rules. For the rendering
architecture, see [frontend.md](../frontend.md).

## Concept and mood

Earthy and human. A CV can feel like a spreadsheet; Terrain makes it feel like a walk through a landscape.

- **Palette:** olive greens and moss neutrals with a rust accent for small labels. Dark mode is a night-time
  version of the same field: deep green-black surfaces and pale sage text.
- **Shapes:** organic. Pill buttons and navigation, "leaf" cards with one sharp corner, a blob around the portrait,
  pebble-shaped monograms, map-pin markers on the experience trail.
- **Texture:** contour lines (`.terrain`) drawn with a repeating radial gradient, never an image.
- **Type:** Bricolage Grotesque, heavy and tightly tracked, for headings; Figtree, friendly and very legible, for
  text.
- **Voice:** first person and warm ("Ciao!", "What I build with", "Things I’ve grown").

## Structure

The design is a Feature-Sliced Design tree in `resources/js/designs/terrain` (TypeScript, `<script setup lang="ts">`).
Each layer imports only from the layers below it and from `resources/js/core` (types, `useProfile`, `useTheme`,
`useSiteMenu`, `usePortfolioFilter`, date and text helpers); other slices are imported through their `index.ts`.
See [frontend.md](../frontend.md).

```
app/                    Layout export (index.ts), layout/SiteLayout.vue, styles/ (the stylesheet entry)
pages/
  about/                About.vue: hero, highlights strip, skills, languages; model: props, highlightStats
  experience/           Experience.vue: work trail, education and awards, courses, certificates; model: props
  portfolio/            Portfolio.vue: page header and the project catalog; model: props
  soft-skills/          SoftSkills.vue: numbered soft-skill cards; model: props
  hobbies/              Hobbies.vue: hobby rows; model: props
widgets/
  site-header/          SiteHeader: brand, navigation, mobile menu (core useSiteMenu), theme toggle
  site-footer/          SiteFooter: "Let’s talk" call to action and profile links
  about-hero/           AboutHero: greeting, headline with a marked last word, portrait
  skill-toolbox/        "What I build with" section
  language-list/        "Languages I speak" section
  experience-trail/     "Where I’ve worked" trail
  milestones/           "Education and awards" section
  course-list/          "Courses" section
  certificate-list/     "Certifications" section
  project-catalog/      Portfolio filter, live region, featured project and category grids
features/
  theme-toggle/         ThemeToggle on core useTheme
  portfolio-filter/     PortfolioFilter buttons and the live-region wording (filterStatus)
entities/
  profile/              TerrainProfile type (headline, bio) and useTerrainProfile
  project/              ProjectCard, ProjectLinks, FeaturedProject
  work/                 TrailStop, trailPositions, currentRoleStop
  education/            DegreeCard, CourseCard, degreesOf
  award/                AwardCard
  certificate/          CertificateCard, certificateIssuer
  language/             LanguageCard, languageLevel
  skill/                SkillCard, skillNames
  soft-skill/           SoftSkillCard
  hobby/                HobbyItem
shared/
  ui/                   BaseButton, BaseIcon, IconButton, EyebrowText, PageHeader, SectionHeading, SurfaceCard,
                        TagList, LeafRating, StatStrip, MonogramBadge (+ the generic CSS helpers)
  lib/                  monogram (Terrain's own initials algorithm), isHttpUrl, isSitePath
```

## Stylesheets

Global CSS only (no `<style>` blocks), so server-rendered pages are styled on first paint.

| Path (under `resources/js/designs/terrain`) | What it holds |
| --- | --- |
| `app/styles/index.css` | Entry point, loaded by `resources/views/app.blade.php`: fonts, tokens, base, then every slice stylesheet. |
| `app/styles/tokens.css` | Primitive and semantic tokens, light and dark. |
| `app/styles/base.css` | Element defaults, focus ring, skip link, `.wrap`, `.visually-hidden`, `.prose`, reduced motion. |
| `app/styles/layout.css`, `app/styles/sections.css` | The page column and main; spacing between page sections, empty state. |
| `<slice>/ui/*.css` | One stylesheet per component, next to it (e.g. `entities/project/ui/project-card.css`). |

The entry imports the slice stylesheets in the original cascade order (shared controls, theme toggle, shared
blocks, trail, filter, project cards, leaf badge, then layout, header, footer, and the page blocks), so rules that
override each other keep their order. Keep that order when adding a file.

## Tokens

Tokens come in two layers:

1. **Primitives** (`--palette-*`, `--font-size-*`, `--space-*`, `--radius-<n>`, `--duration-*`) hold raw values.
   Palette primitives are only used inside `tokens.css`.
2. **Semantic tokens** (`--color-*`, `--text-*`, `--radius-card`, `--motion-*`, ...) say what a value is for.
   Components use semantic colour tokens only. Scale tokens (space, font weight, radius steps) may be used
   directly, since they are already a design decision.

No component contains a raw colour. Dark values are defined under `:root[data-theme="dark"]`, and again under
`@media (prefers-color-scheme: dark)` for `:root:not([data-theme="light"])`, so the operating-system preference
applies until the visitor picks a theme.

### Colour

| Token | Use | Light | Dark |
| --- | --- | --- | --- |
| `--color-bg` | Page background | `#eef0e8` moss-50 | `#151913` night-950 |
| `--color-surface` | Cards, header pill, footer | `#fafbf7` moss-25 | `#1d231b` night-900 |
| `--color-surface-soft` | Chips, current nav item, terrain panels, marker stroke | `#e2e8d6` moss-100 | `#263021` night-800 |
| `--color-text` | Body text, headings | `#1e231b` moss-900 | `#ecefe6` night-50 |
| `--color-text-muted` | Intros, descriptions, meta | `#4c5546` moss-700 | `#aeb7a6` night-300 |
| `--color-border` | Card outlines, dividers (decorative) | `#d5dacb` moss-200 | `#333c2f` night-700 |
| `--color-border-strong` | Outlines of controls (round buttons, filters) | `#7a8471` moss-500 | `#6f7b67` night-500 |
| `--color-accent` | Primary buttons, links, ratings, numbers | `#3f5f2a` olive-700 | `#a9c98b` olive-300 |
| `--color-on-accent` | Text on accent fills | `#fafbf7` moss-25 | `#151913` night-950 |
| `--color-highlight` | Rust eyebrows, dates, counts | `#9a4a1e` rust-700 | `#e79a6b` rust-300 |
| `--color-topo-line` | Contour lines | olive at 10% | olive-300 at 10% |
| `--color-focus` | Focus ring | = accent | = accent |
| `--color-shadow` | Shadow colour | ink at 8% | black at 35% |

#### Contrast (WCAG 2.2 AA)

| Pair | Light | Dark | Needs |
| --- | --- | --- | --- |
| text on bg | 13.9 | 15.3 | 4.5 |
| text on surface | 15.4 | 13.8 | 4.5 |
| text-muted on bg | 6.8 | 8.6 | 4.5 |
| text-muted on surface | 7.5 | 7.7 | 4.5 |
| text-muted on surface-soft | 6.2 | 6.6 | 4.5 |
| accent on bg (links, focus ring) | 6.3 | 9.7 | 4.5 |
| accent on surface | 7.0 | 8.7 | 4.5 |
| on-accent on accent (buttons, featured card) | 7.0 | 9.7 | 4.5 |
| highlight on bg | 5.4 | 7.8 | 4.5 |
| highlight on surface | 6.0 | 7.1 | 4.5 |
| border-strong on bg (control outlines) | 3.4 | 4.0 | 3.0 |
| accent vs border (rating on/off) | 5.1 | 6.2 | 3.0 |

`--color-border` (about 1.4:1) is only used for decorative outlines of non-interactive cards and dividers.

### Typography

| Token | Value | Use |
| --- | --- | --- |
| `--font-display` | Bricolage Grotesque Variable | Headings, numbers, brand, monograms |
| `--font-text` | Figtree Variable | Everything else |
| `--text-display` | 46 → 76px (fluid) | Page `<h1>` |
| `--text-heading` | 34 → 48px | Section `<h2>`, featured project title |
| `--text-heading-xl` | 32 → 44px | Footer call to action, hobby titles |
| `--text-heading-sm` | 28 → 36px | Portfolio category titles, featured soft skill |
| `--text-numeral` | 44 → 64px | Year numerals on Education and awards |
| `--text-stat` | 28 → 36px | Highlight numbers |
| `--text-title-lg` | 24 → 28px | Timeline titles, language names |
| `--text-title-md` | 24px | Card titles |
| `--text-title-sm` | 20px | Small card titles, brand |
| `--text-lead` | 17 → 20px | Intros and bios |
| `--text-body` | 18px | Body text |
| `--text-small` | 16px | Card descriptions, buttons |
| `--text-meta` | 15px | Navigation, dates, meta |
| `--text-label` | 14px | Eyebrows, chips |

Weights: 400 (text), 600 (nav, chips), 700 (buttons, card titles), 800 (display headings). Line heights:
`--leading-tight` 1, `--leading-snug` 1.15, `--leading-body` 1.65. Tracking: display −0.03em, headings −0.02em,
eyebrows +0.08em uppercase.

### Spacing

A 4px grid: `--space-1` 4px, `-2` 8, `-3` 12, `-4` 16, `-5` 20, `-6` 24, `-7` 28, `-8` 32, `-10` 40, `-12` 48,
`-14` 56, `-16` 64, `-18` 72, `-22` 88, `-24` 96.

| Semantic token | Value |
| --- | --- |
| `--layout-max` | 1140px content width |
| `--layout-gutter` | 20 → 40px side padding |
| `--section-gap` | 64 → 96px between sections |
| `--card-padding` | 22 → 28px |
| `--grid-gap` | 20px |
| `--control-height` | 54px (primary buttons) |
| `--control-size` | 48px (round buttons, filters, mobile menu items) |
| `--target-min` | 44px (text links, nav links) |

Breakpoints (media queries cannot read custom properties): navigation collapses below **960px**, grids go to two
columns below 960px and one column below **700px**, hero/feature/hobby rows stack below **860px**.

### Radius

| Token | Value | Use |
| --- | --- | --- |
| `--radius-control` / `--radius-chip` | 999px | Buttons, nav, filters, chips |
| `--radius-tile` | 24px | Even cards, menu panel |
| `--radius-card` + `--radius-card-tip` | 28px / 8px | `--radius-leaf`: three round corners, one sharp |
| `--radius-leaf-flip` | 28/8/28/28 | Alternating leaf |
| `--radius-feature` | 36px | Featured project |
| `--radius-media` | 40px | Hobby rows |
| `--radius-pebble` | 12/20/12/20 | Brand mark, monograms |
| `--radius-blob`, `--radius-blob-inner` | organic percentages | Portrait |
| `--radius-pin` | 50/50/50/12 | Timeline pins (rotated −45°) |

### Shadow and motion

| Token | Value |
| --- | --- |
| `--shadow-raised` | `0 8px 24px var(--color-shadow)`: portrait badge, featured image |
| `--shadow-menu` | `0 16px 40px var(--color-shadow)`: mobile menu |
| `--motion-fast` | 120ms, `cubic-bezier(.2,.7,.2,1)`: button press |
| `--motion-base` | 200ms: hover colours, icon nudge |
| `--motion-slow` | 320ms: brand mark morph |

All motion is removed under `prefers-reduced-motion: reduce` (see `app/styles/base.css`).

## Fonts

Self-hosted from npm, no font CDN:

- `@fontsource-variable/bricolage-grotesque`, `opsz.css` (weight 200–800 and optical size axes).
- `@fontsource-variable/figtree`, `wght.css` (weight 300–900).

Both are variable fonts, so one file per subset covers every weight used. `unicode-range` makes the browser download
only the subsets a page needs (Latin in practice). `font-display: swap` keeps text visible while they load.

## Components

Shared UI is in `shared/ui`; the other components sit in the slice named in the second column. Their styles
sit next to them (see Stylesheets).

| Component | Slice | Props | Notes |
| --- | --- | --- | --- |
| `BaseButton` | `shared/ui` | `href`, `variant` (`primary` \| `ghost`), `icon`, `block` | Inertia `<Link>` for `/paths`, `<a>` for URLs and `mailto:`, `<button>` without `href`. External links open a new tab, say so to screen readers and get an arrow icon. `block` fills the row on phones. |
| `IconButton` | `shared/ui` | `label` (required), `href` | 48px round control. `<a>` with `href`, else `<button>`. The label is the accessible name. |
| `BaseIcon` | `shared/ui` | `name`, `size` | Inline SVG, always `aria-hidden`. Names: sun, moon, menu, close, arrow, external, check, mail, github, linkedin, plus, minus. |
| `ThemeToggle` | `features/theme-toggle` | – | `IconButton` with `aria-pressed` = dark theme on. Uses core `useTheme`; the sun/moon icon is switched with tokens so SSR markup is right before hydration. |
| `EyebrowText` | `shared/ui` | `as` | Rust uppercase label above a heading. |
| `PageHeader` | `shared/ui` | `title`, `eyebrow`, `intro`, `layout` (`stack` \| `split`) | Holds the page’s only `<h1>`. |
| `SectionHeading` | `shared/ui` | `id`, `title`, `eyebrow`, `meta`, `level`, `variant` (`stack` \| `inline`) | Use the same `id` in the section’s `aria-labelledby`. |
| `SurfaceCard` | `shared/ui` | `as`, `shape` (`tile` \| `leaf` \| `leaf-flip`), `tone` (`default` \| `accent`) | Generic card. Use `as="li"` inside lists. |
| `TagList` | `shared/ui` | `tags`, `label`, `limit` | Chips. With `limit`, a "+N more" button (with `aria-expanded`) reveals the rest. |
| `LeafRating` | `shared/ui` | `value`, `max`, `label` | Bars with half steps; `role="img"` with a text label. Always shown next to a text level. |
| `StatStrip` | `shared/ui` | `items` (`[{ value, label }]`), `label` | Highlight numbers. |
| `TrailStop` | `entities/work` | `marker`, `title`, `when`, `org`, `ghost` | One stop inside `<ol class="trail">`. The pin is decorative; dates are in the card. |
| `MonogramBadge` | `shared/ui` | `text`, `size` (`md` \| `xl`) | Initials from a title (`monogram()` in `shared/lib`, Terrain’s own algorithm). Decorative. |
| `PortfolioFilter` | `features/portfolio-filter` | `options` (`[{ value, label, count }]`), `label`, `v-model` | State from core `usePortfolioFilter` (in the `project-catalog` widget). Toggle buttons in a `role="group"`, `aria-pressed` and a check icon on the selected one. Scrolls sideways on phones. |
| `ProjectCard` | `entities/project` | `item`, `headingLevel` | Portfolio grid card; description clamped to 4 lines (the full text stays in the DOM). |
| `ProjectLinks` | `entities/project` | `item` | "Live site" / "Source code" links, new tab, named for screen readers. |
| `FeaturedProject` | `entities/project` | `item`, `eyebrow` | Large card on a terrain panel; falls back to the monogram if the cover image fails. |
| `SiteHeader` | `widgets/site-header` | `name` | Uses core `useSiteMenu`. Brand, nav pill (`aria-current`), theme toggle, menu button (`aria-expanded`, `aria-controls`). Escape closes the menu and returns focus to the button. |
| `SiteFooter` | `widgets/site-footer` | `profile` | "Let’s talk" call to action (email, else LinkedIn, else GitHub: core `contactLink`) and profile links. |
| `SkillCard`, `LanguageCard`, `DegreeCard`, `CourseCard`, `AwardCard`, `CertificateCard`, `SoftSkillCard`, `HobbyItem` | `entities/*` | the entity (`category`, `language`, ...; `index` for numbered ones) | One card or row per item, built on `SurfaceCard` where they are cards. |
| `AboutHero`, `SkillToolbox`, `LanguageList`, `ExperienceTrail`, `Milestones`, `CourseList`, `CertificateList`, `ProjectCatalog` | `widgets/*` | the page data they show | Page sections, each a `<section aria-labelledby>` with its `SectionHeading` (the hero has the `<h1>`); `ProjectCatalog` renders the filter, the featured project and one section per category. |

Example:

```vue
<section aria-labelledby="skills-title">
    <SectionHeading id="skills-title" eyebrow="Toolbox" title="What I build with" />
    <ul class="grid grid--3 plain-list">
        <SurfaceCard v-for="c in categories" :key="c.id" as="li">
            <h3 class="card__title">{{ c.name }}</h3>
            <TagList :tags="c.skills" :label="`${c.name} skills`" />
        </SurfaceCard>
    </ul>
</section>
```

Layout helpers: `.wrap` (centred column), `.grid` + `.grid--2/3/4/certs`, `.grid--fill-last` (a lone last card
spans the row), `.plain-list`, `.terrain`, `.text-link`, `.status-chip`, `.leaf-badge`, `.prose` (admin rich text).

## Content

Everything shown comes from the controllers’ props and from `config/designs.php` (`designs.terrain.profile`, merged over `config/profile.php`):

- `profile.headline` and `profile.bio` (`PROFILE_HEADLINE`, `PROFILE_BIO`) fill the home hero. The h1 reads
  "I’m <first name>, <headline>", with the last word marked. Without a headline the h1 is the name.
- `profile.current_role` adds a "Now" stop at the top of the Experience trail, with
  `current_role.summary` (`PROFILE_CURRENT_SUMMARY`) as its text when set.
- The home page highlights strip uses the `highlights` prop (`projects`, `certificates`, `awards` counts) and the
  number of languages. Zero counts are hidden.
- With no `PROFILE_EMAIL`, "Say hello" becomes "See my experience" and the footer button links to LinkedIn or
  GitHub.

## Accessibility notes

- One `<h1>` per page (in `PageHeader` or the hero); sections use `aria-labelledby`; headings go h1 → h2 → h3.
- Landmarks: header, `nav[aria-label="Primary"]`, `main#main` (skip link target), footer.
- Focus: 3px accent outline with a 3px offset on every focusable element, at least 6.3:1 on the page background.
- Targets: primary controls 48–54px, text and nav links at least 44px tall, chips’ "+N more" button 32px.
- Mobile menu: `aria-expanded`/`aria-controls`, closes with Escape (focus returns to the button) and on navigation.
- Theme switch: stable name "Dark theme" plus `aria-pressed`; the choice is saved in `localStorage.theme`.
- Portfolio filter: `aria-pressed` buttons in a labelled group, and a polite `role="status"` live region that
  announces "Showing N projects in …".
- Not by colour alone: the selected filter also shows a check icon; the current nav item has an outline as well as
  a fill; ratings are paired with a text level and a text label; half ratings fill half a bar.
- Images: the portrait and featured screenshots have alt text; hobby photos sit next to their heading and use
  `alt=""`. External links say "(opens in a new tab)".
- Motion: transitions only, all disabled under `prefers-reduced-motion`.
- SSR: no `window`, `document` or `localStorage` outside `onMounted` and event handlers.
