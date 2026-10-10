# Design system: E · Kinetic

The public site's visual language. It's built from CSS custom properties (`resources/js/designs/kinetic/app/styles/tokens.css`)
and a small set of Vue components, organised with Feature-Sliced Design and written in TypeScript under
`resources/js/designs/kinetic/`. See [frontend.md](../frontend.md) for the architecture.

## Concept and mood

Poster-like and loud, but still disciplined. The look comes from a few elements:

- oversized, uppercase Unbounded headlines that run almost edge to edge;
- 2px black (or white) rules that split the page into slabs;
- a single **signal orange** used as a fill: the ticker band, the featured project, one highlighted row per list.

Everything is square: no radius, and no soft shadows. The only shadow is the hard orange offset block behind the
portrait. Motion is limited to a few things: the scrolling skills band, small hover nudges on buttons, and the
brand square turning on hover. All of it stops under `prefers-reduced-motion`.

## Structure

The design is its own Feature-Sliced Design tree in `resources/js/designs/kinetic/`. A layer imports only from the layers below it and from
the shared core (`resources/js/core`: date and text helpers, entity types, `useProfile`, `useTheme`, `useSiteMenu`,
`usePortfolioFilter`), and other slices only through their `index.ts`.

```
app/                    index.ts (exports Layout), layout/SiteLayout.vue, styles/ (the stylesheet entry, tokens, base)
pages/
  about/                About.vue; model: page props (with `stats`), highlights, ticker words
  experience/           Experience.vue (education, awards, certificates); model: page props, education helpers
  portfolio/            Portfolio.vue
  soft-skills/          SoftSkills.vue
  hobbies/              Hobbies.vue
widgets/
  site-header/          SiteHeader: brand, primary navigation, theme toggle, mobile menu
  site-footer/          SiteFooter: "Let's talk" and the profile links
  work-timeline/        WorkTimeline: the "Work" section (current role, positions newest first, year span)
  project-showcase/     ProjectShowcase: filter, featured project, project index, empty state
features/
  theme-toggle/         ThemeToggle (UI on core useTheme)
  portfolio-filter/     FilterGroup (UI on core usePortfolioFilter) and the live-region wording
entities/
  profile/              KineticProfile (Profile + bio and page intros), nameParts for the hero
  project/              ProjectFeature, ProjectRow
  work/                 TimelineEntry
  language/             LanguageList (language cards), languageLevel
shared/
  ui/                   BaseButton, SmartLink, TagList, SectionHeading, PageHeader, MarqueeTicker, StatList, RatingBlocks
  lib/                  monogram (Kinetic's own rule, see below), brandInitials
```

## Files

| File | Contents |
| --- | --- |
| `app/styles/index.css` | The entry stylesheet, loaded by `resources/views/app.blade.php`: fonts, then every stylesheet below in cascade order. |
| `app/styles/tokens.css` | Primitives (`--p-*`) and semantic tokens, light and dark. |
| `app/styles/base.css` | Element defaults, focus ring, skip link, utilities (`.container`, `.visually-hidden`, `.plain-list`, `.display`, `.label`, `.text-accent`). |
| `app/styles/layout.css` | The page shell (`.site`). |
| `widgets/site-header/ui/site-header.css`, `widgets/site-footer/ui/site-footer.css` | Site header, navigation, mobile menu, footer. |
| `shared/ui/*.css` | Buttons, tags, headings (`SectionHeading` and `PageHeader` share one file: they share a breakpoint block), rating, ticker, stats. |
| `entities/*/ui/*.css`, `features/portfolio-filter/ui/filter-group.css` | Timeline entry and rich text, filter, featured project, project rows, language cards. |
| `pages/*/ui/*.css`, `widgets/project-showcase/ui/project-showcase.css` | Page compositions (hero, stack rows, education panels, certificates, soft skills, hobbies) and the empty state. |

Paths are relative to `resources/js/designs/kinetic/`. Each stylesheet sits next to the component it styles; `index.css` imports them in the
original cascade order (header and footer, shared UI, entities and features, pages), so moving a rule between files
must keep that order.

Rule: components and pages use **semantic tokens only**. Primitives are only referenced inside `tokens.css`.

## Colour tokens

Dark values apply under `[data-theme="dark"]`. When the visitor has not chosen a theme, they also apply under
`@media (prefers-color-scheme: dark)` (for `:root:not([data-theme="light"])`). The contrast column gives the ratio
against the usual background.

| Token | Light | Dark | Use | Contrast (light / dark) |
| --- | --- | --- | --- | --- |
| `--color-bg` | `#FFFFFF` | `#0A0A0A` | Page background | — |
| `--color-surface` | `#F4F4F4` | `#141414` | Hover rows, highlighted timeline entry | — |
| `--color-text` | `#0A0A0A` | `#F5F5F5` | Body and headings | 19.8 / 18.2 |
| `--color-text-muted` | `#4B4B4B` | `#B3B3B3` | Secondary text | 8.7 / 9.4 (7.9 / 8.8 on surface) |
| `--color-line` | `#0A0A0A` | `#F5F5F5` | 2px structural rules, borders of controls | 19.8 / 18.2 |
| `--color-hairline` | `#E3E3E3` | `#262626` | 1px row separators (decorative only) | — |
| `--color-accent` | `#FF5A1F` | `#FF6A33` | Fills, rating blocks, indicators | 3.1 / 6.9 (UI ≥ 3:1) |
| `--color-accent-text` | `#B83A0A` | `#FF7A45` | Orange text at any size | 5.8 / 7.7 |
| `--color-on-accent` | `#0A0A0A` | `#0A0A0A` | Text on accent fills | 6.4 / 6.9 |
| `--color-inverse-bg` / `--color-inverse-text` | `#0A0A0A` / `#FFFFFF` | `#F5F5F5` / `#0A0A0A` | Inverse button, hover of square buttons | 19.8 / 18.2 |
| `--color-focus` | `#0A0A0A` | `#F5F5F5` | Focus outline | ≥ 6:1 on every fill |

The bright orange is never used for text on white, because it reaches only 3.1:1. Orange text always uses
`--color-accent-text`.

## Typography

| Font | Package | Role |
| --- | --- | --- |
| Unbounded (variable, 200–900) | `@fontsource-variable/unbounded` | `--font-display`: headlines, numbers, ticker |
| Public Sans (variable, 100–900) | `@fontsource-variable/public-sans` | `--font-body`: text, labels, buttons |

Both fonts are self-hosted and imported at the top of `app/styles/index.css` from the packages' `wght.css`. That file holds the
normal style only, with one variable file per script subset, and the browser downloads only the subsets a page
uses. The weights in use are 400, 600, 700, 800 and 900 (`--weight-*`).

### Type scale

Display sizes are fluid: they scale with the viewport between 390px and 1280px wide.

| Token | Size (390 → 1280) | Used for |
| --- | --- | --- |
| `--text-display-hero` | 48 → 168px | The name on the home page |
| `--text-display-2xl` | 52 → 150px | Short page titles ("Work."), the featured monogram |
| `--text-display-xl` | 32 → 104px | Page titles |
| `--text-display-footer` | 44 → 120px | "Let's talk" |
| `--text-display-figure` | 56 → 88px | Figures in the education panels |
| `--text-display-l` | 30 → 64px | Section titles |
| `--text-display-stat` | 36 → 64px | Highlights, timeline years |
| `--text-display-feature` | 26 → 56px | Featured project title |
| `--text-display-index` | 22 → 40px | Soft-skill numbers |
| `--text-display-m` | 20 → 32px | Role and soft-skill titles |
| `--text-display-s` | 19 → 30px | Stack rows, project rows |
| `--text-display-card` | 22 → 28px | Hobby titles |
| `--text-display-xs` | 18 → 26px | Ticker, language names, certificates |
| `--text-display-2xs` | 16 → 22px | Project numbers |
| `--text-lead` | 17 → 21px | Intros |
| `--text-body` / `--text-body-s` | 18 / 16px | Body text |
| `--text-small` | 15px | Captions |
| `--text-label-l` / `--text-label` / `--text-label-s` | 14 / 13 / 12px | Uppercase labels, nav, buttons, tags |

Tracking: `--tracking-giant` (−0.06em), `--tracking-display` (−0.05em), `--tracking-heading` (−0.035em),
`--tracking-tight` (−0.02em), `--tracking-meta` (0.06em), `--tracking-label` (0.12em), `--tracking-kicker`
(0.16em).

Line height: `--leading-display` (0.88), `--leading-heading` (1.02), `--leading-ui` (1), `--leading-body` (1.6).

**Overflow:** Unbounded is very wide. The smallest size of each display token was chosen so that the longest
single word on a page fits a 390px screen ("EXPERIENCE.", "LANGUAGES", "INTERACTIVE"). Headings also have
`overflow-wrap: break-word` as a safety net for longer data. Keep this in mind before raising a minimum size.

## Spacing, sizes, radius, shadow

| Token | Value |
| --- | --- |
| `--space-1` … `--space-14` | 4, 8, 12, 16, 20, 24, 28, 32, 40, 48, 56, 72, 88, 96px |
| `--space-gutter` | 18 → 48px (page side padding) |
| `--space-section` | 56 → 88px (gap above each section) |
| `--space-page-top` | 32 → 56px |
| `--space-card` | 22 → 36px (panel padding) |
| `--size-container` | 1200px |
| `--size-measure` | 760px (long text) |
| `--size-target` / `--size-target-l` | 44px (controls) / 56px (calls to action) |
| `--size-header` / `--size-header-compact` | 76px / 64px |
| `--border-thin` / `--border-strong` / `--border-indicator` | 1 / 2 / 4px |
| `--focus-width` / `--focus-offset` | 3px / 3px |
| `--radius-none` | 0 (the only radius) |
| `--shadow-block` | 16px 16px 0 accent (portrait slab) |
| `--shadow-press` | 4px 4px 0 line (button hover) |

## Motion

| Token | Value | Use |
| --- | --- | --- |
| `--duration-fast` | 120ms | Hover colour changes, button nudge |
| `--duration-base` | 200ms | Brand square rotation, menu icon, theme icon |
| `--duration-ticker-item` | 2.4s | The ticker loop lasts this × the number of words |
| `--ease-out` | `cubic-bezier(0.2, 0.8, 0.2, 1)` | All transitions |

Under `prefers-reduced-motion: reduce`, every animation and transition is cut to 0.01ms. The ticker stops completely
and its pause button is hidden.

## Breakpoints

- **Below 56rem (896px):** the navigation collapses behind the Menu button, and the hero CTA moves to its own row.
- **Below 45rem (720px):** grids stack, the highlights become 2 × 2, and section headings stack.

## Components

Components live in the slice that matches what they are: generic UI in `shared/ui`, business things in `entities`,
interactions in `features`, composed blocks in `widgets` (see [Structure](#structure)). Props are typed with
`defineProps<...>()`; data types come from the core entities (`Project`, `Language`, `Company`, ...).

| Component | Props | Notes |
| --- | --- | --- |
| `SiteHeader` (widget) | — | Brand monogram (initials of `profile.name`, with the full name for screen readers), primary nav with `aria-current="page"`, `ThemeToggle`, Menu button (`aria-expanded`, `aria-controls`). Escape closes the menu and returns focus to the button; navigating also closes it. |
| `SiteFooter` (widget) | — | "Let's talk" link to the email, else LinkedIn, else GitHub; copyright row and profile links. |
| `ThemeToggle` (feature) | — | Square 44px button with `aria-pressed` and a label that says what it does; uses core `useTheme`, which stores the choice in `localStorage.theme`. |
| `SmartLink` | `href` | Internal paths use the Inertia `<Link>`. `http(s)` links open in a new tab and add "(opens in a new tab)" for screen readers. Other links (such as `mailto:`) stay plain anchors. |
| `BaseButton` | `href?`, `variant` (`accent`, `inverse`, `outline`), `size` (`m` 44px, `l` 56px), `block`, `type` | Renders a link (with an → or ↗ arrow) or a `<button>`. |
| `TagList` | `tags: string[]`, `label` = "Technologies" | Outlined uppercase chips in a labelled list. |
| `SectionHeading` | `id`, `title`, `kicker?`, `level` = 2 | Big title over a 2px rule, with an orange kicker. Point the section's `aria-labelledby` at `id`. |
| `PageHeader` | `title`, `accent?`, `intro?`, `size` (`xl`, `2xl`), `layout` (`stack`, `split`, `grid`), `ruled`, `accentBlock` | The page's `<h1>`. `title` + `accent` are joined with no space, so "Experi" + "ence." reads as one word. |
| `MarqueeTicker` | `items: string[]` | Orange scrolling band, hidden from assistive technology because it repeats on-page content. It has a pause button (`aria-pressed`, WCAG 2.2.2) and is static under reduced motion. |
| `StatList` | `items: StatItem[]` (`{value, label}`), `label` | The row of big figures. |
| `RatingBlocks` | `value`, `max` = 5 | Five outlined blocks, full or half filled; `role="img"` with an "x out of 5" label. |
| `TimelineEntry` (entity work) | `year`, `period`, `title`, `org`, `tags`, `highlight`, `headingLevel` = 3; default slot = description | Renders an `<li>`, so use it inside an `<ol>`. |
| `FilterGroup` (feature) | `options: {value, label, count}[]`, `v-model`, `label`, `status` | Toggle buttons with `aria-pressed` in a labelled group, and a `role="status"` polite live region. The selected filter shows a filled square as well as the orange fill. |
| `ProjectFeature` (entity project) | `item: Project`, `index`, `category` | The featured project: an orange slab with a monogram (decorative, from `monogram()`), then the title, description, tags, and live/source buttons. |
| `ProjectRow` (entity project) | `item: Project`, `index`, `category` | A project index row. The title links to the live site (else the source), and the link covers the whole row. A "Code" link is added when both URLs exist. |
| `LanguageList` (entity language) | `languages: Language[]` | The grid of language cards: name, level (`languageLevel`: "Native", else the speaking level, plus the certificate) and `RatingBlocks`. |
| `WorkTimeline` (widget) | `companies`, `currentRole`, `location` | The Experience "Work" section: a highlighted "Now" entry for the current role, then every position newest first; the kicker is the year span ("2011 — now"). |
| `ProjectShowcase` (widget) | `categories: ProjectCategory[]` | The portfolio body: `FilterGroup` on core `usePortfolioFilter` (by category id), the first visible project as `ProjectFeature`, then a `ProjectRow` per visible project. The live region reads "Showing all 15 projects" or "Showing 2 projects in Projects in Java". Shows "No projects to show yet." when there are none. |

### Usage

```vue
<section class="section" aria-labelledby="work-title">
    <SectionHeading id="work-title" title="Work" kicker="2011 — 2020" />
    <ol class="timeline plain-list">
        <TimelineEntry year="2020" period="Jun 2020 – Nov 2020" title="Developer" org="Acme · Varese" :tags="['PHP']">
            <p>What I did.</p>
        </TimelineEntry>
    </ol>
</section>

<BaseButton href="/portfolio">See the work</BaseButton>
<BaseButton :href="repoUrl" variant="outline" size="m">Source code</BaseButton>
```

## Content sources

All facts come from the database through the page props. Copy that has no data source is configured in
`config/designs.php` (`designs.kinetic.profile`, merged over `config/profile.php`) and can be overridden with env variables; leave a value empty to hide it.

| Config key | Env | Shown on |
| --- | --- | --- |
| `profile.bio` | `PROFILE_BIO` | Home: the text next to the portrait |
| `profile.intros.experience` / `portfolio` / `soft_skills` / `hobbies` | `PROFILE_INTRO_*` | The text under each page title |
| `profile.current_role.company`, `.since`, `.summary` | `PROFILE_CURRENT_COMPANY`, `PROFILE_CURRENT_SINCE`, `PROFILE_CURRENT_SUMMARY` | Experience: a highlighted "Now" entry. It is only shown when a company is set. |
| `profile.email`, `profile.linkedin_url` | `PROFILE_EMAIL`, `PROFILE_LINKEDIN_URL` | Footer links and the "Let's talk" target |

Derived values: the home page highlights count portfolio projects, certificates, awards and languages (the `stats`
prop). The education figure is the last year in the programme's period. An award's figure is its placing (as in
"2nd place" → "#2") when the title names one, and its year otherwise.

The featured project's monogram (`shared/lib/monogram.ts`) is Kinetic's own rule: a single camel-cased word keeps its
last capitals ("ItalianPSQ" → "PSQ"), several words give the initials of up to three of them, skipping "and", "of",
"the", "with" and "in" ("Interactive CV and Portfolio" → "ICP"), and anything else its first three letters. The header
brand uses the first letter of each word of the name, at most three (`brandInitials`). Both are pinned by unit tests.

## Accessibility notes

- Every page has one `<h1>` (from `PageHeader`, or the name on the home page), headings in order, and
  `aria-labelledby` on its sections.
- Skip link to `#main`. The 3px focus outline uses `--color-focus`, so it stays visible on white, black and
  orange.
- Targets: nav links, square buttons, certificate links and footer links are at least 44px; calls to action are
  56px; the smallest target ("Code" in project rows) is 32px.
- Colour is never the only signal:
  - the current page has an underline bar and `aria-current`;
  - the selected filter has a filled square and `aria-pressed`;
  - ratings use filled versus outlined blocks and have a text label.
- External links say that they open in a new tab. Decorative numbers, monograms and arrows are `aria-hidden`.
- Images: the portrait has alt text. Hobby photos illustrate the title next to them, so their alt is empty.
- SSR-safe: `window`, `document` and `localStorage` are only used in `onMounted` or event handlers.
