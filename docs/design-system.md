# Design system · Editorial

The public site is laid out like a magazine: big serif headlines, a strict grid with a date or number column on
the left, black rules between sections and a single cobalt accent. The mood is calm and confident, closer to a
printed feature than to an app. Colour is used sparingly: almost everything is black on white (or bone on night
in dark mode), and the accent marks what matters: numerals, emphasised words, the current page, links.

- **Display:** Instrument Serif, regular weight only, tight leading and slightly negative tracking.
- **Text and UI:** Geist, 400 to 600.
- **Structure:** 1px rules (`--color-rule`) separate sections; hairlines (`--color-hairline`) separate rows.
  Sections get roman numerals (i., ii., …); lists get two-digit numbers (01, 02, …).
- **Shape:** square corners everywhere; the only round things are the portrait, the rating dots and the theme switch.

## Files

| Path | What it holds |
| --- | --- |
| `resources/css/tokens.css` | Primitive and semantic tokens, light and dark. |
| `resources/css/base.css` | Element defaults, focus ring, `.wrap`, `.visually-hidden`, reduced motion. |
| `resources/css/layout.css` | Skip link, masthead, navigation and mobile menu, theme switch, footer. |
| `resources/css/components.css` | Styles of the components in `resources/js/components`. |
| `resources/css/pages.css` | Page compositions (hero, intro, skill index, languages, lists). |
| `resources/css/app.css` | Imports the fonts and the files above, in that order. |

## Tokens

Primitives (`--p-*`) hold the raw values and are used only inside `tokens.css`. Everything else uses semantic
tokens. Dark values are set under `:root[data-theme='dark']` and, when no theme was picked, under
`@media (prefers-color-scheme: dark)` for `:root:not([data-theme='light'])`.

### Colour

| Token | Light | Dark | Use |
| --- | --- | --- | --- |
| `--color-bg` | `#FFFFFF` | `#0F0F10` | Page background |
| `--color-surface` | `#F4F4F2` | `#18181A` | Footer, feature plate, image placeholders |
| `--color-text` | `#111111` | `#F2F2F0` | Body text and headings |
| `--color-text-muted` | `#545454` | `#ABABAB` | Meta text, descriptions, inactive nav and filters |
| `--color-rule` | `#111111` | `#F2F2F0` | Section rules, masthead and footer borders |
| `--color-hairline` | `#DADADA` | `#2E2E31` | Row separators (decorative) |
| `--color-accent` | `#1F3FD1` | `#9DAEFF` | Kickers, numerals, emphasis, underlines |
| `--color-on-accent` | `#FFFFFF` | `#0F0F10` | Text on the accent (selection, hover of solid buttons) |
| `--color-inverse-bg` / `--color-inverse-text` | `#111111` / `#FFFFFF` | `#F2F2F0` / `#0F0F10` | Solid buttons, skip link |
| `--color-focus` | `#1F3FD1` | `#9DAEFF` | Focus ring |

Contrast (WCAG 2.2):

| Pair | Light | Dark |
| --- | --- | --- |
| text on bg / surface | 18.9 / 17.2 | 17.1 / 15.8 |
| muted on bg / surface | 7.6 / 6.9 | 8.3 / 7.7 |
| accent on bg / surface | 7.8 / 7.1 | 9.1 / 8.4 |
| inverse text on inverse bg | 18.9 | 17.1 |
| on-accent on accent | 7.8 | 9.1 |

Every text pair passes AA (most pass AAA). Hairlines are decorative only: no control relies on them for its boundary.

### Type scale

Display sizes are fluid (`clamp()`) between the 390px and 1280px layouts.

| Token | Size | Font | Use |
| --- | --- | --- | --- |
| `--fs-display-1` | 54 → 112px | Serif | Page `<h1>` |
| `--fs-feature-title` | 44 → 64px | Serif | Featured project title |
| `--fs-display-2` | 44 → 72px | Serif | Footer call to action |
| `--fs-display-3` | 40 → 56px | Serif | Section titles, hobby titles |
| `--fs-standfirst` | 28 → 40px | Serif italic | Soft-skills standfirst |
| `--fs-heading-1` | 30 → 38px | Serif | Timeline entry and soft-skill titles |
| `--fs-heading-2` | 28 → 36px | Serif | Project rows, languages, date markers |
| `--fs-heading-3` | 26 → 32px | Serif | Skill index, certificates, small numerals |
| `--fs-numeral` | 30 → 44px | Serif | Section numerals |
| `--fs-plate` | 80 → 120px | Serif | Feature plate number |
| `--fs-drop-cap` | 72px | Serif | Drop cap of the bio |
| `--fs-brand` | 24 → 30px | Serif | Site name |
| `--fs-lede` | 18 → 21px | Sans | Page ledes |
| `--fs-body-lg` | 19px | Sans | Hobby text, byline name |
| `--fs-body` | 18px | Sans | Body |
| `--fs-small` | 15px | Sans | Nav, meta, footer |
| `--fs-label` | 13px | Sans 600, uppercase, `--tracking-label` .14em | Kickers, group labels |

Line heights: `--lh-plate` .8, `--lh-tight` .95, `--lh-display` 1.05, `--lh-heading` 1.15, `--lh-meta` 1.5,
`--lh-body` 1.6, `--lh-label` 1. Tracking: `--tracking-display` −.02em, `--tracking-heading` −.01em.

### Spacing

4px base: `--space-1` 4 · `--space-2` 8 · `--space-3` 12 · `--space-4` 16 · `--space-5` 20 · `--space-6` 24 ·
`--space-8` 32 · `--space-10` 40 · `--space-12` 48 · `--space-14` 56 · `--space-16` 64 · `--space-18` 72 ·
`--space-24` 96.

Fluid layout spacing:

| Token | Range | Use |
| --- | --- | --- |
| `--space-gutter` | 20 → 48px | Side padding of `.wrap` |
| `--space-section` | 44 → 72px | Section padding |
| `--space-page-top` | 44 → 80px | Space above page titles |
| `--space-column` | 24 → 64px | Column gaps |

Sizes: `--size-content` 1160px, `--size-measure` 760px, `--size-label-col` 200px (date column),
`--size-label-col-sm` 120px, `--size-target` 44px, `--size-target-lg` 48px, `--size-header` 64 → 84px, plus the
component sizes listed in `tokens.css`.

### Borders, radius, shadow

| Token | Value |
| --- | --- |
| `--border-rule` | 1px solid `--color-rule` |
| `--border-rule-heavy` | 3px solid `--color-rule` (top of "At a glance") |
| `--border-hairline` | 1px solid `--color-hairline` |
| `--underline-thickness` / `--underline-offset` | 2px / 8px (current page, pressed filter) |
| `--radius-none` / `--radius-full` | 0 / 999px |
| `--shadow-none` | The design uses rules instead of shadows. |

### Motion

| Token | Value | Use |
| --- | --- | --- |
| `--duration-fast` | 120ms | Colour changes on hover |
| `--duration-base` | 200ms | Theme-switch knob, project-row arrow |
| `--ease-standard` | `cubic-bezier(0.2, 0, 0, 1)` | All transitions |

All transitions are cut to ~0 under `prefers-reduced-motion: reduce`.

### Breakpoints

Media queries cannot read custom properties, so the two breakpoints are written as numbers:

- `max-width: 999px`: the navigation collapses into the Menu panel.
- `max-width: 700px`: page layouts become a single column.

## Fonts

Self-hosted through npm, imported in `resources/css/app.css` (no third-party font CDN):

| Package | Files imported | Use |
| --- | --- | --- |
| `@fontsource/instrument-serif` | `400.css`, `400-italic.css` | Display |
| `@fontsource-variable/geist` | `wght.css` (variable weight axis) | Text and UI |

The `@font-face` rules use `font-display: swap` and `unicode-range`, so the browser only downloads the subsets a
page uses (Latin in practice).

## Components

All live in `resources/js/components/`. They have no scoped styles; their classes are in `components.css`
(header and footer in `layout.css`).

| Component | Props | Notes |
| --- | --- | --- |
| `SiteHeader` | `name` | Brand, numbered primary nav with `aria-current`, `ThemeToggle`, Menu button (`aria-expanded`, `aria-controls`; Escape closes and returns focus to it). |
| `SiteFooter` | `profile` | "Let's work together." links to `profile.email` (or `linkedin_url`); availability note; copyright and links. Parts hide when their value is empty. |
| `ThemeToggle` | — | "Dark mode" button with `aria-pressed`; a small switch shows the state by the knob position. Uses `useTheme`. |
| `Kicker` | `as` = `'p'` | Uppercase accent overline. |
| `PageHeader` | `kicker`, `lede`, `layout` (`stack`/`split`), `ledeStyle` (`plain`/`standfirst`), `ruled` | Renders the page's `<h1>` from the default slot. |
| `SectionHeading` | `id`, `title`, `numeral`, `level` = 2, `compact` | Decorative numeral (`aria-hidden`) and the heading the section's `aria-labelledby` points to. |
| `EmphasisText` | `text` | Renders `*word*` as an accent italic `<em>`, without `v-html`. |
| `ActionLink` | `href`, `variant` (`solid`/`underline`), `external`, `arrow` | Internal links use Inertia `<Link>`. Solid is 48px tall, underline 44px. |
| `MetaList` | `items`, `label` | Inline list separated by middle dots (technologies, tags). |
| `RatingDots` | `value`, `max` = 5 | Full / half / empty dots (shape, not colour); `role="img"` with "2.5 out of 5". |
| `FactList` | `id`, `title`, `items` [{label, value}] | "At a glance" aside with a `<dl>`; default slot for an action. |
| `TimelineEntry` | `marker`, `when`, `title`, `org`, `headingLevel` = 3 | Date column + body slot. The title comes first in the source; CSS puts the date on the left. |
| `FilterBar` | `options` [{value, label, count}], `label`, `v-model` | Toggle buttons with `aria-pressed` inside a labelled `role="group"`. Pair it with a live region. |
| `FeaturedProject` | `project`, `number`, `category`, `headingId` | Plate (cover image, or the project number when there is none or it fails to load) and the project details and links. |
| `ProjectRow` | `project`, `number` | Whole row links to the live site, else the source code; rows without links are static. Summary is clamped to 3 lines. |
| `StoryBlock` | `title`, `text`, `numeral`, `imageUrl`, `imageAlt`, `flip` | Picture beside a numbered title, alternating sides. |

Usage example:

```vue
<PageHeader :kicker="pageKicker('Hobbies')" :lede="profile.intros.hobbies">Off the clock</PageHeader>

<section class="section" aria-labelledby="work-title">
    <SectionHeading id="work-title" numeral="i" title="Work" />
    <TimelineEntry marker="2020" when="Jun 2020 – Nov 2020" title="Developer" org="Company · City">
        <p class="entry__text">…</p>
    </TimelineEntry>
</section>
```

`pageKicker(component)` (from `composables/useNavigation.js`) returns the numbered overline, such as
"02 — Experience", so page numbers always match the navigation.

## Content

Every fact comes from the page props or from `config/profile.php` (shared as `profile`). Copy that has no data
source is configurable, with `PROFILE_*` env variables:

| Key | Env | Default |
| --- | --- | --- |
| `headline` | `PROFILE_HEADLINE` | "I love bringing a product from an \*idea\* to \*reality\*." |
| `bio` | `PROFILE_BIO` | The introduction of the previous site, in four paragraphs |
| `intros.experience` / `portfolio` / `soft_skills` / `hobbies` | `PROFILE_INTRO_*` | Neutral one-line ledes |
| `current_role.summary` | `PROFILE_CURRENT_SUMMARY` | empty |

The "Now" entry on the Experience page appears only when `PROFILE_CURRENT_COMPANY` is set. The footer call to
action appears only when `PROFILE_EMAIL` or `PROFILE_LINKEDIN_URL` is set.

## Accessibility notes

- One `<h1>` per page (in `PageHeader`, or the hero on About); headings go h1 → h2 → h3 without gaps. Sections
  use `aria-labelledby`.
- Skip link to `#main`; a 3px `--color-focus` outline with a 3px offset on every focusable element.
- Navigation: `aria-current="page"` on the current link, which is also underlined (not only darker).
- Targets: nav links, text buttons, footer links and filters are at least 44px tall; solid buttons 48px.
- Theme toggle: `aria-pressed`, constant label "Dark mode"; state shown by the switch position.
- Menu: `aria-expanded` and `aria-controls`; Escape closes it and moves focus back to the button; it also closes
  on navigation.
- Portfolio filter: `aria-pressed` buttons in a labelled group, and a visually hidden `role="status"`
  (`aria-live="polite"`) that announces "Showing 2 projects in Projects in Java."
- Rating dots differ by shape (filled, half, outline) and have a text alternative.
- Decorative numerals and arrows are `aria-hidden`; links whose text repeats ("Certificate", "Source code") have
  visually hidden context. The portrait has alt text; hobby photos and project covers are decorative because
  the heading next to them says what they show.
- `prefers-reduced-motion` removes transitions; nothing animates on its own.
- SSR: no `window`, `document` or `localStorage` outside `onMounted` and event handlers; each page has a single
  root element.
