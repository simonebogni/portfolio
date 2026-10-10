# Design system: Blueprint

## Concept and mood

**Blueprint** presents the site owner as an engineering leader and product partner: someone who still writes code,
leads a team of developers, and works directly with customers' designers and product managers.

The look borrows from technical drawings: a faint engineering-paper grid behind page titles, mono "spec" labels
(`01 · What I bring`, `fig. 01`), spec sheets (`<dl>` label/value rows), dashed wires in the "How I work" diagram, and
inverted "block" panels for the most important facts. One teal accent carries every interactive and highlighted
element. The mood is calm, precise and confident, with no decoration that does not explain something.

The team size shown everywhere (diagram, stats, role scope, copy) comes from `profile.current_role.team_size`
(`PROFILE_TEAM_SIZE`, default 15). Config copy can include `:team_size`, which the front end replaces.

## Files

| Path | Holds |
| --- | --- |
| `resources/css/designs/blueprint/tokens.css` | Primitive and semantic tokens, light and dark. |
| `resources/css/designs/blueprint/base.css` | Element defaults, focus ring, `.container`, `.visually-hidden`, `.skip-link`, `.is-placeholder`, `.blueprint-grid`, reduced motion. |
| `resources/css/designs/blueprint/layout.css` | Header, navigation, mobile menu, footer. |
| `resources/css/designs/blueprint/components.css` | Styles for the components below. |
| `resources/css/designs/blueprint/pages.css` | Page-specific compositions (hero, toolbox grid, current role, working model, hobby cards). |
| `resources/js/designs/blueprint/components/` | Vue components. |
| `resources/js/designs/blueprint/lib/profile.js` | `fillProfile`, `isPlaceholder`, `initials`, `isExternal`, `contactLink`, `emphasisSegments`. |
| `resources/js/designs/blueprint/composables/useProfile.js` | The shared `profile` prop, `teamSize`, `contact` link and `fill()`. |

All styles are global CSS imported by `app.css` (no scoped component styles), so the SSR-rendered HTML is fully
styled before the page's JavaScript chunk loads. Components only use semantic tokens.

## Tokens

### Colour

Primitives: an `--ink-*` ramp (950 darkest to 50 lightest, plus `--white`) and a `--teal-*` ramp. Components use
only the semantic tokens below.

| Token | Use | Light | Dark |
| --- | --- | --- | --- |
| `--color-bg` | Page background | `#f5f7f8` (ink-50) | `#0a1117` (ink-950) |
| `--color-surface` | Cards, header | `#ffffff` | `#111b23` (ink-850) |
| `--color-text` | Body text | `#0f1b24` (ink-900) | `#e7eef2` (ink-100) |
| `--color-text-muted` | Secondary text | `#475663` (ink-600) | `#9fb0bc` (ink-300) |
| `--color-line` | Decorative borders, dividers | `#d3dce2` (ink-150) | `#23323e` (ink-800) |
| `--color-line-strong` | Borders of controls (buttons, filters) | `#7a8b97` (ink-450) | `#5e7280` (ink-500) |
| `--color-grid` | Blueprint grid lines | ink-900 at 6% | ink-100 at 5% |
| `--color-accent` | Links, highlights, primary buttons | `#0b6e6e` (teal-700) | `#5fd4c7` (teal-300) |
| `--color-on-accent` | Text on accent | `#ffffff` | `#0a1117` |
| `--color-accent-soft` | Tags, icon tiles, current nav item | `#e3f2f1` (teal-100) | `#12302e` (teal-900) |
| `--color-block` | Inverted panels (footer, role scope, group headers) | `#0f1b24` | `#e7eef2` |
| `--color-on-block` | Text on block | `#f5f7f8` | `#0a1117` |
| `--color-on-block-muted` | Secondary text and rules on block | `#b7c4cd` | `#3b4b57` |
| `--color-focus` | Focus ring | teal-700 | teal-300 |
| `--color-focus-on-block` | Focus ring inside block panels | teal-300 | teal-700 |

Contrast (WCAG 2.2, computed):

| Pair | Light | Dark |
| --- | --- | --- |
| text / bg | 16.3 | 16.2 |
| text-muted / bg | 7.0 | 8.5 |
| text-muted / surface | 7.6 | 7.8 |
| accent / bg | 5.6 | 10.6 |
| accent / accent-soft (tags) | 5.3 | 7.9 |
| on-accent / accent (buttons) | 6.1 | 10.6 |
| on-block / block | 16.3 | 16.2 |
| on-block-muted / block | 9.8 | 7.7 |
| line-strong / surface (control borders, 3:1) | 3.5 | 3.5 |
| focus / bg (3:1) | 5.6 | 10.6 |
| focus-on-block / block (3:1) | 9.8 | 5.2 |

`--color-line` is only used for decorative dividers and card outlines, never as the only boundary of a control.

### Type

Fonts: **Schibsted Grotesk** (variable, 400–900; we use 400, 500, 600, 700, 800) for everything, **DM Mono** 400
and 500 for labels, kickers, chips and metadata. Both are self-hosted with Fontsource
(`@fontsource-variable/schibsted-grotesk`, `@fontsource/dm-mono`), imported at the top of `app.css`.

| Token | Desktop | ≤ 700px | Use |
| --- | --- | --- | --- |
| `--text-xs` | 12px | | Mono labels, chips |
| `--text-sm` | 13px | | Mono kickers, tags |
| `--text-md` | 15px | | Nav, secondary text |
| `--text-base` | 16px | | Buttons, lists |
| `--text-body` | 17px | | Body |
| `--text-lede` | 19px | 17px | Intros |
| `--text-h4` | 20px | | Card titles |
| `--text-h3` | 22px | | Sub-headings |
| `--text-h3-lg` | 30px | 24px | Case and role titles |
| `--text-stat` | 34px | 26px | Stats strip |
| `--text-footer` | 36px | 26px | Footer call to action |
| `--text-h2` | 38px | 28px | Section titles |
| `--text-big` | 44px | 36px | Big numbers in cards |
| `--text-hero` | 54px | 34px | Home headline |
| `--text-display` | 56px | 36px | Page titles |

Weights: `--weight-regular` 400, `-medium` 500, `-semibold` 600, `-bold` 700, `-heavy` 800. Line heights:
`--leading-tight` 1.06, `-snug` 1.15, `-body` 1.6, `-mono` 1.4. Tracking: `--tracking-tight` −0.025em,
`-snug` −0.02em, `-label` 0.06em, `-kicker` 0.08em.

### Spacing (4px base)

| Token | Value | Token | Value |
| --- | --- | --- | --- |
| `--space-1` | 4px | `--space-10` | 40px |
| `--space-2` | 8px | `--space-12` | 48px |
| `--space-3` | 12px | `--space-14` | 56px |
| `--space-3-5` | 14px | | |
| `--space-4` | 16px | `--space-16` | 64px |
| `--space-5` | 20px | `--space-18` | 72px |
| `--space-6` | 24px | `--space-20` | 80px |
| `--space-7` | 28px | `--space-24` | 96px |
| `--space-8` | 32px | | |

Layout: `--container-max` 1160px, `--gutter` 40px (18px on mobile), `--header-height` 72px (64px), `--grid-cell`
32px, `--section-heading-aside` 280px, measures `--measure-narrow` 560px, `--measure` 680px, `--measure-wide` 780px.
Sizes: `--size-mark` 36px, `--size-avatar` 52px, `--size-icon-tile` 48px, `--size-hobby-image` 230px (200px).

### Radius, borders, targets

| Token | Value | Use |
| --- | --- | --- |
| `--radius-dot` | 3px | Timeline markers |
| `--radius-xs` | 6px | Tags, chips |
| `--radius-sm` | 8px | Buttons, nav, filters |
| `--radius-md` | 10px | Diagram nodes, list rows |
| `--radius-lg` | 14px | Cards |
| `--border-thin` / `--border-thick` | 1px / 2px | |
| `--target-min` | 24px | WCAG 2.2 minimum target |
| `--target-primary` | 44px | Nav, icon buttons, filters, text links |
| `--button-height` | 50px | Buttons |

### Shadow and motion

| Token | Value |
| --- | --- |
| `--shadow-raised` | Two-layer ink shadow (light); a single black shadow (dark). Used by the open mobile menu. |
| `--duration-fast` | 120ms (hover colour changes) |
| `--duration-base` | 200ms |
| `--ease-standard` | `cubic-bezier(0.2, 0, 0, 1)` |

Every transition and animation is cut to ~0 under `prefers-reduced-motion: reduce` (`base.css`).

### Breakpoints

`≤ 700px` (`43.75em`): mobile layout and token overrides. `≤ 1024px` (`64em`): three-column grids drop to two,
the home hero stacks.

## Components

| Component | Props | Notes |
| --- | --- | --- |
| `AppButton` | `href`, `variant` (`primary` \| `ghost`) | Internal paths use Inertia `<Link>`; `http(s)` links open a new tab and say so; `mailto:` stays a plain link. |
| `TextLink` | `href`, `context` | Accent link with arrow (internal) or ↗ (external). `context` is sr-only text that makes repeated link texts unique. |
| `BpIcon` | `name`, `size` | Decorative SVG, always `aria-hidden`. Names: sun, moon, menu, close, dot, check, arrow, external, team, partnership, code. |
| `TagLabel` | `dot` | Mono pill above titles. |
| `DraftText` | `text`, `as` | Renders config text; `[PLACEHOLDERS]` get the `.is-placeholder` draft style. |
| `PageHeader` | `tag`, `title`, `intro`; default slot | Grid band with the page's single `<h1>`. The slot holds extras such as the filter. |
| `SectionHeading` | `id`, `kicker`, `title`, `level` | Mono kicker + title; use `id` as the section's `aria-labelledby`. |
| `ChipList` | `items`, `label`, `variant` (`outline` \| `soft`) | Labelled list of mono chips. |
| `SpecList` | `items` (`{ label, value }`), `variant` (`plain` \| `block`) | `<dl>` spec sheet; empty values are skipped. |
| `StatStrip` | `items` (`{ value, label }`), `label` | Full-width stats row; empty values are skipped. |
| `FeatureCard` | `icon`, `title`, `level`; default slot | Icon tile + title + text. |
| `TimelineEntry` | `when`, `title`, `level`; default slot | One `<li>` of an `<ol class="timeline">`. |
| `CaseCard` | `kind`, `title`, `summary`, `meta`, `draft`, `level`; `actions` slot | Case study `<li>` with a spec sheet. `draft` adds the dashed placeholder border. |
| `FilterGroup` | `options` (`{ value, label }`), `label`; `v-model` | Toggle buttons with `aria-pressed` in a labelled group; the pressed one also shows a check icon. |
| `CollaborationMap` | `partners`, `leadName`, `leadTitle`, `leadFocus`, `teamSize`, `portrait` | The "How I work" figure: partners → lead → team (one dot per developer). The drawing is `aria-hidden`; a visually hidden sentence describes it. |
| `ThemeToggle` | – | Uses `useTheme`; `aria-pressed` = dark, label says what it does. |

Layout (`SiteLayout.vue`): skip link, header with brand mark (initials), primary nav (relabelled "Case studies" and
"How I work"), theme toggle and mobile menu button, and the footer with the contact band. The contact button uses
`contactLink()`: email, else LinkedIn, else GitHub.

Usage example:

```vue
<section class="section" aria-labelledby="stack-title">
    <SectionHeading id="stack-title" kicker="02 · Toolbox" title="Programming knowledge" />
    ...
</section>
```

## Content sources

| Page | From the database | From `config/designs.php` (`designs.blueprint.profile`, merged over `config/profile.php`) |
| --- | --- | --- |
| About | Skills, languages, `highlights` (first work year, portfolio project count) | `headline`, `intro`, `collaboration`, `strengths`, `current_role.title`, `team_size` |
| Experience | Companies, positions, education, online courses, certificates, awards | `current_role.*`, `page_intros.experience` |
| Portfolio | Categories and items | `featured_case_study`, `page_intros.portfolio` |
| Soft skills | Soft skills | `working_model`, `soft_skill_groups`, `page_intros.soft_skills` |
| Hobbies | Hobbies | `hobby_notes`, `page_intros.hobbies` |
| Footer | – | `contact_prompt`, `email`, `linkedin_url`, `github_url` |

Portfolio layout rule: with "All" selected, items of the first (highest priority) category are full case cards and
the others are listed under "More projects"; selecting a category shows its items as cards.

### Placeholders to fill in

Values in `[SQUARE BRACKETS]` render in the dashed, italic draft style until replaced:

- `current_role.company` (`PROFILE_CURRENT_COMPANY`): `[CURRENT COMPANY]`
- `current_role.since` (`PROFILE_CURRENT_SINCE`, `YYYY-MM`): `[START DATE]`
- `current_role.outcomes`: `[2–3 OUTCOMES …]`
- `featured_case_study.title`, `.summary`, `.stack`, `.outcome` (and optional `.url`); set `title` to `null` to hide the card.

Also unset by default (the related links are hidden until set): `PROFILE_EMAIL`, `PROFILE_LINKEDIN_URL`. Without
them, the contact buttons point to GitHub.

## Accessibility notes

- One `<h1>` per page (hero or `PageHeader`), headings in order; sections use `aria-labelledby`.
- Landmarks: header, `nav[aria-label=Primary]`, `main#main` (skip link target), footer.
- Focus: 2px `--color-focus` outline with offset; inside block panels `--color-focus-on-block` keeps 3:1.
- Targets: nav links, icon buttons, filters, text links and footer links are ≥ 44px tall; buttons 50px.
- Mobile menu: `aria-controls`, `aria-expanded`, label switches between "Open menu"/"Close menu"; Escape closes it
  and returns focus to the button; it closes on navigation.
- Theme toggle: `aria-pressed` plus an action label; the choice is saved and applied before first paint.
- Portfolio filter: `role=group` with toggle buttons (`aria-pressed`), a check icon on the selected one (not colour
  alone), and a polite `role=status` live region announcing "Showing N projects …".
- Current nav item: `aria-current="page"`, shown with background and an underline bar (not colour alone).
- External links open a new tab and say so in visually hidden text; repeated link texts get sr-only context.
- The "How I work" diagram is `aria-hidden` and described in a sentence; hobby photos are decorative (`alt=""`),
  the portrait in the diagram is decorative too.
- All animation respects `prefers-reduced-motion`. Everything is SSR-safe: browser APIs are only touched in
  `onMounted` or event handlers.
