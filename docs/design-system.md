# Design system · "Source"

The public site's look: a code-crafted portfolio that reads like a well-kept repository. This page lists the
tokens, fonts and components, and the accessibility rules they follow. The architecture (Inertia, SSR, layouts)
is described in [frontend.md](frontend.md).

## Concept and mood

- **Code as the visual language.** The navigation is a row of editor tabs (`about.vue`, `experience.vue`, …), page
  titles have a code-comment or shell-command eyebrow (`$ ls ./projects`), and the home page shows the profile as a
  small source file with line numbers and syntax colours.
- **Calm and precise.** Light grey canvas, white bordered cards, one blue accent. No gradients and almost no
  shadows: structure comes from 1px borders and generous spacing.
- **Two voices.** IBM Plex Sans for reading, JetBrains Mono for anything "machine": labels, tags, dates, tabs,
  numbers.
- **Everything real.** All facts come from the database or `config/profile.php`. The code window, stat cards and
  counts are computed from the props, never written by hand.

## Files

| Path | What it holds |
| --- | --- |
| `resources/css/tokens.css` | Primitive (`--p-*`) and semantic tokens, light and dark, mobile overrides. |
| `resources/css/base.css` | Element defaults, focus ring, skip link, utilities (`.visually-hidden`, `.bare-list`, `.prose`), reduced motion. |
| `resources/css/layout.css` | Container, header and tab navigation, mobile menu, footer. |
| `resources/css/components/*.css` | One file per component family. |
| `resources/css/pages.css` | Page compositions (hero, grids, page-specific blocks). |
| `resources/css/app.css` | Entry: imports fonts, tokens, base, layout, components and pages, in that order. |
| `resources/js/components/*.vue` | The Vue components listed below. |

Rule: components and pages only use **semantic** tokens. Primitives exist so the palette can be changed in one
place; they are never referenced outside `tokens.css`.

## Colour

Dark values apply with `[data-theme="dark"]` (the visitor's choice, saved in `localStorage.theme`) and with
`prefers-color-scheme: dark` when no choice was made (`:root:not([data-theme="light"])`).

| Token | Use | Light | Dark |
| --- | --- | --- | --- |
| `--color-bg` | Page canvas | `#F6F7F9` | `#0B0E14` |
| `--color-surface` | Cards, header, footer | `#FFFFFF` | `#121722` |
| `--color-surface-sunken` | Chips, code bar, hover, image placeholders | `#EEF1F5` | `#1A2130` |
| `--color-text` | Body text, headings | `#0E1116` | `#E6EAF2` |
| `--color-text-muted` | Secondary text, captions | `#4A5363` | `#A3ADBF` |
| `--color-border` | Card and divider lines (decorative) | `#D9DEE6` | `#263042` |
| `--color-border-control` | Outline of buttons and toggles | `#828B9D` | `#5A6884` |
| `--color-accent` | Links, primary button, eyebrows, active tab | `#0B57D0` | `#7AB7FF` |
| `--color-on-accent` | Text on the accent | `#FFFFFF` | `#0B0E14` |
| `--color-accent-soft` | Active tab, badges, pressed icon buttons | `#E8F0FD` | `#16243B` |
| `--color-focus` | Focus ring | `#0B57D0` | `#7AB7FF` |
| `--color-syntax-keyword` | Code window: keywords | `#7A2DB8` | `#D2A8FF` |
| `--color-syntax-string` | Code window: strings | `#1B6B3A` | `#8FDCA8` |
| `--color-syntax-literal` | Code window: numbers, literals | `#9A4A00` | `#FFB86B` |

### Contrast (WCAG 2.2 AA)

| Pair | Light | Dark | Needs |
| --- | --- | --- | --- |
| text on bg | 17.6 | 16.0 | 4.5 |
| text on surface | 18.9 | 14.9 | 4.5 |
| muted on bg / surface / sunken | 7.2 / 7.8 / 6.8 | 8.5 / 7.9 / 7.1 | 4.5 |
| accent on bg / surface | 6.0 / 6.4 | 9.2 / 8.6 | 4.5 |
| accent on accent-soft (badges, award icon) | 5.6 | 7.4 | 4.5 |
| on-accent on accent (primary button, pressed filter) | 6.4 | 9.2 | 4.5 |
| syntax keyword / string / literal on surface | 7.3 / 6.5 / 6.3 | 9.2 / 11.1 / 10.5 | 4.5 |
| border-control on bg / surface | 3.2 / 3.4 | 3.5 / 3.2 | 3 (UI) |
| focus ring on bg | 6.0 | 9.2 | 3 (UI) |

`--color-border` is below 3:1 on purpose: it only outlines cards, which never rely on their border to be
understood. Interactive controls use `--color-border-control`.

## Typography

| Token | Font |
| --- | --- |
| `--font-sans` | IBM Plex Sans (400, 500, 600, 700), `@fontsource/ibm-plex-sans` |
| `--font-mono` | JetBrains Mono Variable (100–800 axis), `@fontsource-variable/jetbrains-mono` |

Both are self-hosted through npm and bundled by Vite (imported at the top of `app.css`); no font CDN. Only the
weights above are imported. Each weight file declares `unicode-range` subsets, so browsers download Latin only.

| Token | Desktop | Mobile (≤700px) | Use |
| --- | --- | --- | --- |
| `--text-display` | 64px | 44px | Home page name (h1) |
| `--text-h1` | 56px | 40px | Page titles |
| `--text-h2` | 36px | 28px | Section headings |
| `--text-h2-sm` | 30px | 28px | Portfolio category headings |
| `--text-feature` | 34px | 28px | Featured project title |
| `--text-h3-lg` | 24px | 21px | Company names, hobby titles |
| `--text-h3` | 20px | 20px | Card titles, languages |
| `--text-h4` | 19px | 19px | Positions, certificates, soft skills |
| `--text-role` | 20px | 16px | Roles under the name (mono) |
| `--text-lead` | 19px | 17px | Hero bio, page introductions |
| `--text-body` | 17px | 17px | Body copy |
| `--text-body-sm` | 16px | 16px | Buttons, project descriptions |
| `--text-small` | 15px | 15px | Captions, meta, footer |
| `--text-code` | 15px | 13px | Code window |
| `--text-mono-label` | 14px | 14px | Tabs, eyebrows, filters, mono links |
| `--text-chip` | 13px | 13px | Chips, dates |
| `--text-overline` | 12px | 12px | Uppercase labels, counts |
| `--text-stat` | 22px | 18px | Stat values |

Line heights: `--leading-none` 1, `--leading-tight` 1.05 (big titles), `--leading-feature` 1.1, `--leading-snug`
1.2, `--leading-heading` 1.3, `--leading-label` 1.4, `--leading-body` 1.65, `--leading-code` 1.75. Letter spacing:
`--tracking-tight` −0.02em (h1), `--tracking-snug` −0.01em (h2), `--tracking-overline` 0.08em (uppercase labels).

## Spacing, sizes, radius, shadow, motion

Spacing is a 4px grid with a few half steps that the layout needs.

| Token | Value | | Token | Value |
| --- | --- | --- | --- | --- |
| `--space-0-5` | 2px | | `--space-8` | 32px |
| `--space-1` | 4px | | `--space-9` | 36px |
| `--space-1-5` | 6px | | `--space-10` | 40px |
| `--space-2` | 8px | | `--space-12` | 48px |
| `--space-2-5` | 10px | | `--space-14` | 56px |
| `--space-3` | 12px | | `--space-16` | 64px |
| `--space-3-5` | 14px | | `--space-18` | 72px |
| `--space-4` | 16px | | `--space-20` | 80px |
| `--space-5` | 20px | | `--space-22` | 88px |
| `--space-5-5` | 22px | | `--space-24` | 96px |
| `--space-6` | 24px | | | |
| `--space-7` | 28px | | | |

Layout tokens: `--container` 1120px, `--gutter` 40px (20px mobile), `--header-height` 68px (60px mobile),
`--section-gap` 96px (64px mobile), `--page-top` 80px (48px mobile).

Targets: `--target-min` 24px (all links and toggles), `--target-primary` 44px (icon buttons, filters),
`--target-button` 48px (buttons, mobile menu links).

| Radius | Value | Use |
| --- | --- | --- |
| `--radius-sm` | 8px | Chips, brand mark |
| `--radius-md` | 10px | Buttons, icon buttons, filters, badges |
| `--radius-lg` | 12px | Avatar, cover sketch |
| `--radius-xl` | 14px | Cards, code window |
| `--radius-2xl` | 16px | Featured project, hobby cards |
| `--radius-full` | 999px | Bars, dots |

Shadows are used sparingly: `--shadow-sm` and `--shadow-md` (mobile menu panel, primary button hover); dark mode
uses deeper, neutral shadows.

| Motion | Value | Use |
| --- | --- | --- |
| `--duration-fast` | 120ms | Hover colour changes |
| `--duration-base` | 200ms | Button arrow nudge |
| `--ease-standard` | `cubic-bezier(0.2, 0, 0, 1)` | All transitions |

All transitions and animations are switched off under `prefers-reduced-motion: reduce` (`base.css`).

Breakpoints (documented in `tokens.css`, since custom properties can't be used in media queries): **1040px**
(tabs collapse into the menu button; three-column grids become two) and **700px** (single column, mobile type
scale).

## Components

All in `resources/js/components/`. Each has a matching stylesheet in `resources/css/components/`.

| Component | Props | Notes |
| --- | --- | --- |
| `AppIcon` | `name`, `size = 20` | Inline stroke icons (sun, moon, menu, close, arrowRight, pin, cap, github, linkedin, mail, trophy, external, code, check). Always `aria-hidden`. |
| `AppButton` | `href`, `variant = primary \| ghost`, `icon` | Link styled as a 48px button. Internal paths use Inertia `<Link>`. Inside `.btn-row--stack` buttons go full width on mobile. |
| `IconButton` | `icon`, `label`, `href?` | 44×44 square. `label` is the accessible name. Renders `<a>` with `href`, otherwise `<button>`; extra attributes (`aria-pressed`, `aria-expanded`, `@click`) pass through. |
| `ThemeToggle` | – | `IconButton` wired to `useTheme`: `aria-pressed` = dark, label says what it does ("Switch to dark theme"). |
| `TextLink` | `href`, `context?` | Mono accent link for secondary actions. `context` is added for screen readers only ("View certificate: Data Visualization"). |
| `ChipList` | `items`, `label = 'Technologies'` | Tag list with an accessible name. Renders nothing when empty. |
| `BaseCard` | `as = 'div'`, `padding = md \| lg \| none`, `dashed` | The bordered surface. Use `as="li"` inside lists and `as="article"` for standalone entries. |
| `PageHeader` | `title`, `eyebrow?`, `intro?`, `tight` | Holds the page's only `<h1>`. The eyebrow is decorative (`aria-hidden`). |
| `SectionHeading` | `id`, `title`, `comment?`, `level = 2`, `size = md \| sm` | Pair `id` with the section's `aria-labelledby`. The `// comment` is decorative. |
| `CodeWindow` | `filename`, `lines`, `label` | Editor pane. `lines` = array of lines, each an array of `{ text, kind }` tokens (`keyword`, `string`, `literal`). The code is `aria-hidden`; the figure is named by `label`; the default slot becomes a readable `figcaption`. |
| `StatList` | `items`, `label = 'Highlights'` | Grid of `{ value, label }` facts. |
| `RatingBar` | `value`, `max = 5` | `role="img"` with "4.5 out of 5". Always shown next to a text level. |
| `TimelineList` | `label?` | Vertical `<ol>` with the accent rail. |
| `TimelineEntry` | `title`, `startDate`, `endDate`, `current`, `period`, `headingLevel = 4` | Dates as `<time>`; falls back to the `period` text. Default slot for the description and chips. |
| `PortfolioFilter` | `v-model`, `options`, `label` | Toggle buttons with `aria-pressed` in a labelled group. The pressed one also shows a check mark, so state isn't conveyed by colour alone. Counts are read as "(3 projects)". |
| `ExpandableText` | `text`, `clampFrom = 220`, `lines = 4`, `context?` | Clamps long text with a "Show more" button (`aria-expanded`, `aria-controls`). |
| `ProjectCover` | `title`, `imageUrl?`, `mock` | Decorative cover: a monogram (or an abstract UI sketch with `mock`), with the screenshot layered on top as a background image, so a missing image never shows as broken. |
| `ProjectCard` | `item`, `headingLevel = 3` | Portfolio card: year, title, subtitle, description, "Live demo" / "Source code" links. |
| `FeaturedProject` | `item`, `category` | Wide card for the first project of the current selection, with tags and button links. |

### Composition examples

```vue
<PageHeader eyebrow="$ ls ./projects" title="Portfolio" :intro="profile.intros.portfolio" />

<section aria-labelledby="skills-title">
    <SectionHeading id="skills-title" title="Programming knowledge" comment="tools I reach for" />
    <ul class="skill-grid bare-list">
        <BaseCard v-for="category in skillCategories" :key="category.id" as="li">…</BaseCard>
    </ul>
</section>

<AppButton href="/portfolio" icon="arrowRight">View my work</AppButton>
<PortfolioFilter v-model="selected" :options="options" label="Filter projects by category" />
```

## Content sources

| On screen | Source |
| --- | --- |
| Name, roles, location, links | `profile` (shared prop, `config/profile.php`) |
| Hero bio and avatar caption | `profile.bio`, `profile.tagline` (`PROFILE_BIO`, `PROFILE_TAGLINE`; defaults from the original About page) |
| Page introductions | `profile.intros.*` (`PROFILE_INTRO_*`; neutral defaults, empty hides them) |
| Stat cards, degree in the hero | `highlights` prop of the About page (counts and names from the database) |
| Code window | Generated from `profile` and the skill categories and languages props |
| Current role card (Experience) | `profile.current_role`, shown only when `PROFILE_CURRENT_COMPANY` is set and no position is marked current |

## Accessibility notes

- Landmarks: skip link → `<header>` with `<nav aria-label="Primary">`, `<main id="main">`, `<footer>`.
- One `<h1>` per page (`PageHeader`, or the hero on the home page); headings go h1 → h2 → h3 → h4 in order; every
  section has `aria-labelledby`.
- The current tab has `aria-current="page"` and is marked by an underline and background, not only by colour.
- Menu button: `aria-expanded`, `aria-controls="site-menu"`, label switches between "Open menu"/"Close menu".
  Escape closes it and returns focus to the button; it also closes on navigation.
- Theme button: `aria-pressed` and an action label. The pre-paint script in `app.blade.php` avoids a flash.
- Portfolio filter: toggle buttons with `aria-pressed`, a check icon on the pressed one, and a polite
  `role="status"` region announcing "Showing 2 projects in Projects in Java."
- Focus: a 3px `--color-focus` outline on every focusable element (`:focus-visible`), inset on the tabs.
- Targets: icon buttons and filters 44px, buttons and mobile menu links 48px, text links at least 24px tall.
- Decorative content (eyebrows, `// comments`, code lines, covers, icons, hobby photos whose subject is the heading
  below) is hidden from assistive tech; the portrait has alt text.
- Rating bars always sit next to the level in words; dates use `<time datetime>`.
- No `window`, `document` or `localStorage` access outside `onMounted` and event handlers, so every page renders on
  the server.
