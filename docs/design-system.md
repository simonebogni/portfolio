# Design system · G "Principal"

## Concept and mood

Quiet senior leadership. The site has to show two things at once: an experienced developer who still writes
code, and a Tech Lead who manages a team of developers and works directly with customers' designers and product
managers.

- **Editorial, not flashy:** a warm off-white page, near-black text and a single indigo accent. Most of the
  hierarchy comes from type, hairlines and white space, not from colour or boxes.
- **Serif voice, sans structure:** large Newsreader headlines carry the voice, and Hanken Grotesk handles body
  text, labels and controls.
- **Leadership first:** the About page leads with the role (team size, partners, principles); craft (toolkit,
  languages, projects) follows. The team size always comes from `profile.current_role.team_size`.
- **One dark band per page at most:** the "deep" band (principles, featured engagement) inverts the palette.

## Files

| Path | Holds |
| --- | --- |
| `resources/css/tokens.css` | Primitive and semantic tokens, light and dark. |
| `resources/css/base.css` | Element defaults, focus ring, utilities (`.visually-hidden`, `.is-placeholder`, `.muted`). |
| `resources/css/layout.css` | `.wrap` container, site header, navigation, footer. |
| `resources/css/components/*.css` | One file per group of components (actions, typography, lists, cards, portfolio). |
| `resources/css/pages.css` | Page grids (hero, band, experience layout, hobby grid). |
| `resources/js/components/*.vue` | The components below. |
| `resources/js/lib/copy.js` | Copy helpers: `{team_size}` templates, `*emphasis*`, placeholders. |
| `resources/js/composables/useProfile.js` | The shared `profile` prop, `fill()` and the preferred contact link. |

Styles are global CSS files imported by `app.css` (not `<style>` blocks in the components), so server-rendered
pages are styled on first paint even though page components are loaded lazily.

## Tokens

Components use **semantic** tokens only. Primitives (`--gray-*`, `--indigo-*`) exist only to define them.

### Colour

| Token | Light | Dark | Use |
| --- | --- | --- | --- |
| `--color-bg` | `#F7F7F5` | `#0E0F12` | Page background |
| `--color-surface` | `#FFFFFF` | `#16181D` | Cards, floating caption |
| `--color-text` | `#16181D` | `#ECEDF0` | Body text, headings |
| `--color-text-muted` | `#50545E` | `#A3A7B1` | Secondary text, labels |
| `--color-line` | `#E2E2DE` | `#2A2D35` | Hairlines (decorative) |
| `--color-line-strong` | `#16181D` | `#ECEDF0` | Rules above section headings |
| `--color-control-border` | `#85888F` | `#6B6F79` | Outline of pill buttons (3:1) |
| `--color-accent` | `#3B3FB8` | `#A9ADFF` | Emphasis, eyebrows, counters, focus ring |
| `--color-accent-ink` | `#FFFFFF` | `#0E0F12` | Text on the accent |
| `--color-accent-soft` | `#ECECFA` | `#1D1F38` | Chips, pressed theme toggle, hover |
| `--color-inverse-bg` / `-text` | `#16181D` / `#F7F7F5` | `#ECEDF0` / `#0E0F12` | Solid buttons, pressed filter |
| `--color-deep-bg` | `#16181D` | `#ECEDF0` | Dark band background |
| `--color-deep-text` | `#F7F7F5` | `#0E0F12` | Text in the band |
| `--color-deep-muted` | `#B9BCC6` | `#454955` | Secondary text and rules in the band |
| `--color-focus` | accent | accent | Focus ring (`--color-deep-text` inside `.tone-deep`) |

Contrast (WCAG 2.2), measured:

| Pair | Light | Dark |
| --- | --- | --- |
| text / bg | 16.6 | 16.4 |
| text-muted / bg | 7.1 | 8.0 |
| text-muted / surface | 7.6 | 7.4 |
| accent / bg | 7.6 | 9.2 |
| text / accent-soft (chips) | 15.2 | 13.7 |
| inverse-text / inverse-bg (buttons) | 16.6 | 16.4 |
| deep-text / deep-bg | 16.6 | 16.4 |
| deep-muted / deep-bg | 9.4 | 7.7 |
| control-border / bg (non-text, ≥ 3) | 3.3 | 3.8 |

`--color-line` is below 3:1 on purpose: hairlines are decorative and never the only way to identify a control.

### Type

Fonts: `--font-display` (Newsreader) and `--font-body` (Hanken Grotesk). Fluid sizes interpolate linearly
between the 390px and 1280px mockups with `clamp()`.

| Token | Mobile → desktop | Used for |
| --- | --- | --- |
| `--font-size-display-xl` | 42 → 76px | About hero `h1` |
| `--font-size-display-lg` | 42 → 72px | Page `h1` |
| `--font-size-display-md` | 38 → 60px | Footer call to action |
| `--font-size-heading-xl` | 32 → 46px | Section `h2`, band title, featured title |
| `--font-size-heading-lg` | 30 → 40px | Timeline titles, compact section headings |
| `--font-size-heading-md` | 28 → 38px | Soft skill names |
| `--font-size-heading-sm` | 26 → 32px | Project titles, hobby titles, pull quote |
| `--font-size-title-lg` | 30px | Pillar titles |
| `--font-size-title` | 22 → 26px | Principle titles, testimonials, brand |
| `--font-size-title-sm` | 22px | Definition terms, glance values |
| `--font-size-numeral-lg` | 48 → 64px | Big figures (score, placing) |
| `--font-size-lede` | 18 → 20px | Lede paragraphs |
| `--font-size-body` | 18px | Body |
| `--font-size-body-sm` | 17px | Dense lists |
| `--font-size-caption` | 15px | Captions, footer row |
| `--font-size-ui` | 14px | Navigation, buttons, chips |
| `--font-size-label` | 13px | Uppercase eyebrows and kickers |
| `--font-size-micro` | 12px | Soft skill group labels |

Weights: `--weight-regular` 400, `--weight-medium` 500, `--weight-semibold` 600, `--weight-bold` 700.
Line heights: `--line-height-tight` 1.02, `-heading` 1.1, `-snug` 1.3, `-body` 1.65. Tracking:
`--tracking-display` −0.025em, `-heading` −0.02em, `-ui` 0.04em, `-label` 0.16em.

### Spacing

| Token | Value | | Token | Value |
| --- | --- | --- | --- | --- |
| `--space-1` | 4px | | `--space-10` | 40px |
| `--space-2` | 8px | | `--space-12` | 48px |
| `--space-3` | 12px | | `--space-14` | 56px |
| `--space-4` | 16px | | `--space-16` | 64px |
| `--space-5` | 20px | | `--space-18` | 72px |
| `--space-6` | 24px | | `--space-gutter` | 20 → 48px (page sides) |
| `--space-7` | 28px | | `--space-section` | 64 → 96px (between sections) |
| `--space-8` | 32px | | `--space-page-top` | 44 → 88px (above page titles) |
| | | | `--space-band` / `--space-panel` | 56 → 88px / 24 → 48px |

Layout: `--container-max` 1140px, `--header-height` 68 → 92px. Targets: `--target-min` 24px,
`--target-primary` 44px, `--target-cta` 54px.

### Radius, shadow, motion

| Token | Value |
| --- | --- |
| `--radius-sm` | 4px (images, cards, panels) |
| `--radius-pill` | 999px (buttons, chips, filters) |
| `--shadow-raised` | `0 12px 32px` 8% black (40% in dark) |
| `--duration-fast` / `--duration-base` | 120ms / 200ms |
| `--ease-standard` | `cubic-bezier(0.2, 0, 0, 1)` |

Motion is limited to colour changes and a 1px lift on buttons, and is switched off under
`prefers-reduced-motion: reduce`.

## Fonts

Self-hosted from npm, no third-party requests:

- `@fontsource-variable/newsreader`: `opsz.css` and `opsz-italic.css` (weight and optical-size axes; the italic
  is used for emphasis, counters and quotes).
- `@fontsource-variable/hanken-grotesk`: `wght.css` (no italic).

Each file declares `unicode-range` subsets, so browsers download only the latin files they need.

## Components

| Component | Props | Notes |
| --- | --- | --- |
| `ActionLink` | `href`, `variant` (`solid` \| `inverse` \| `text`) | Internal paths use Inertia `<Link>`. Solid buttons are 54px tall and full-width under 700px. |
| `PillButton` | `pressed` (optional Boolean) | Outlined 44px button. Sets `aria-pressed` only when `pressed` is given. |
| `ThemeToggle` | — | Uses `useTheme`; `aria-pressed` shows whether the dark theme is on. |
| `SiteHeader` | — | Brand, primary nav (`aria-current`), theme toggle, disclosure menu under 860px (`aria-expanded`, `aria-controls`, Escape closes and returns focus). Labels: "Selected work" (Portfolio), "Principles" (Soft skills). |
| `SiteFooter` | — | Contact headline (`copy.contact_headline`), location · availability, contact button (email, else LinkedIn, else GitHub), links. |
| `Eyebrow` | `tone` (`accent` \| `muted` \| `deep`) | Uppercase label above a title. |
| `PageHeader` | `eyebrow`, `title`, `lede`, `layout` (`stack` \| `split`); slot `lede` | Renders the page's only `<h1>`. |
| `SectionHeading` | `id`, `title`, `kicker`, `size` (`lg` \| `md`) | `<h2>` with a rule above; pair with `aria-labelledby` on the section. |
| `EmphasisText` | `text` | Renders `*words*` as `<em class="emphasis">` (accent italic). No `v-html`. |
| `ChipList` | `items`, `label` | `<ul aria-label>` of chips. |
| `DefinitionRows` | `items` (`{ term, detail, placeholder? }`), `variant` (`rows` \| `stacked` \| `deep`) | Toolkit, "At a glance", featured facts. |
| `NumberedList` | `items` (`{ title, text, label? }`), `variant` (`grid` \| `wide`), `tone`, `headingLevel` | Principles (grid, deep) and soft skills (wide, `h2`). Counters are `aria-hidden`; the `<ol>` carries the order. |
| `PillarList` | `items` (`{ title, text }`) | "Three roles, one person" columns with roman counters. |
| `PortraitFigure` | `src`, `alt`, `figure`, `caption` | Portrait with a floating caption card. |
| `TestimonialCard` | `quote`, `name`, `role` | Dashed outline while any field is a placeholder. |
| `TimelineEntry` | `when`, `title`, `org`, `whenPlaceholder`; slots default, `chips` | One role in the experience timeline (`<li>`). |
| `RecognitionCard` | `figure`, `title`, `text`; default slot | Education, award and certificate cards. |
| `FeaturedEngagement` | `id`, `eyebrow`, `title`, `summary`, `facts`, `href`, `linkLabel` | Dark panel at the top of the Portfolio page. |
| `FilterGroup` | `options` (`{ value, label }`), `v-model`, `label`, `controls` | `role="group"` of `aria-pressed` buttons. Pair with a polite `role="status"` region. |
| `WorkRow` | `item`, `category` | Project row; the title link covers the row (live site, else source), plus a separate "Source" link when both exist. |
| `HobbyCard` | `hobby`, `featured` | The first hobby is featured (taller image, spans two rows). |

Example:

```vue
<section class="section" aria-labelledby="toolkit-title">
    <SectionHeading id="toolkit-title" title="Toolkit and languages." kicker="Hands-on" />
    <DefinitionRows :items="[{ term: 'PHP', detail: 'Laravel, CakePHP' }]" />
</section>
```

## Content and configuration

The pages use only props from the controllers and the shared `profile` prop. Copy with no database source lives
in `config/profile.php`:

| Key | Use |
| --- | --- |
| `current_role.title`, `.company`, `.since`, `.team_size` | Current role everywhere (team size is never hard-coded). |
| `current_role.summary`, `.highlights`, `.scope` | Current role entry on the Experience page. |
| `copy.headline`, `copy.intro` | About hero (`PROFILE_HEADLINE`, `PROFILE_INTRO`). |
| `copy.works_with` | "Works with" / "Partners" facts. |
| `copy.experience_intro`, `copy.portfolio_intro` | Page ledes. |
| `copy.contact_headline` | Footer call to action. |
| `leadership_roles`, `principles` | About page lists. |
| `testimonials` | About page quotes (empty the list to hide the section). |
| `featured_engagement` | Portfolio featured panel (`title` null hides it). |
| `soft_skill_groups`, `soft_skill_quote` | Soft skill group labels and order, and the pull quote. |
| `availability` | Shown next to the location in the footer. |

Conventions: `{team_size}`, `{title}`, `{company}` and `{location}` are filled in by `useProfile().fill()`;
`*words*` are shown in the accent italic; text in `[SQUARE BRACKETS]` is a placeholder and is shown in the
muted italic / dashed placeholder style.

Values derived from the data rather than written: years of experience and "building software since" (earliest
position), the average course score (graded courses), the award placing (parsed from the award title), the
certificate issuer heading, and the project count.

### Placeholders to fill in

- `current_role.highlights`: `[Two or three outcomes you are proud of.]`
- `testimonials`: two quotes with `[QUOTE …]`, `[NAME]` and `[COMPANY]`.
- `featured_engagement`: `[ENGAGEMENT TITLE]`, the `[What the customer needed …]` summary,
  `[MEASURABLE RESULT]`, and optionally `url` (`PROFILE_FEATURED_URL`) for the "Read the story" button.
- Env values that are empty by default and hide their UI until set: `PROFILE_EMAIL` (enables "Start a
  conversation" and the email link), `PROFILE_LINKEDIN_URL`, `PROFILE_AVAILABILITY`, `PROFILE_CURRENT_COMPANY`,
  `PROFILE_CURRENT_SINCE`.

## Accessibility notes

- One `<h1>` per page, headings in order; every section is labelled with `aria-labelledby`.
- Skip link, landmarks (`header`, `nav aria-label="Primary"`, `main#main`, `footer`), `aria-current="page"`.
- Focus: 3px `--color-focus` outline with offset; inside dark bands it switches to the band text colour. The
  project row link draws its focus ring around the whole row.
- Targets: navigation links, pill buttons and footer links are 44px tall, call-to-action buttons 54px, the
  "Source" link at least 24px.
- The theme toggle has a stable name ("Dark theme") and `aria-pressed`; the menu button has `aria-expanded`
  and `aria-controls`, and Escape closes the menu and returns focus to it.
- The portfolio filter uses `aria-pressed` buttons in a labelled group; a polite status region announces
  "Showing N projects in …". The pressed filter is shown by fill and text colour, not hue alone.
- Decorative counters and arrows are `aria-hidden`. Hobby photos have empty `alt` because the caption names
  them; the portrait has descriptive alt text. Placeholders are marked by text ([BRACKETS]) and style, not by
  colour alone.
- No `window`, `document` or `localStorage` access outside `onMounted` or event handlers (SSR-safe).
