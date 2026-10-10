# Front end

The public site (About, Experience, Portfolio, Soft skills, Hobbies) is a Vue 3 app served through
[Inertia](https://inertiajs.com) with server-side rendering. The Filament admin panel and the auth pages are
unchanged and keep using Blade.

The site ships with several **designs** (Source, Bento, Terrain, Kinetic, Blueprint). They share the
controllers, routes and data, but each has its own layout, pages, components and stylesheet. The admin chooses the
live one in the admin panel; see [Designs](#designs).

## How a page is rendered

1. A controller in `app/Http/Controllers` loads the models and returns `self::render('<Page>', $props)`, which
   adds the props that only the active design needs. Props are plain arrays with camelCase keys: the Vue code
   never sees Eloquent models.
2. `HandleInertiaRequests` adds the shared props: `design` (the active design), `profile` (config/profile.php
   with the active design's copy merged in) and `designPreview` (only set while an admin previews a design).
3. `resources/views/app.blade.php` is the only Blade view for the public site. It sets the meta tags, applies
   the saved theme before the first paint, loads the active design's stylesheet, and outputs `@inertiaHead` /
   `@inertia`.
4. With SSR on, Laravel posts the page to the Node SSR server (`bootstrap/ssr/ssr.js`), which returns the
   rendered HTML. The browser then hydrates it with `resources/js/app.js`. If the SSR server is down, Inertia
   falls back to client-side rendering, so the site keeps working.

## Files

| Path | What it holds |
| --- | --- |
| `resources/js/app.js` / `ssr.js` | Client and SSR entry points. `ssr.js` must stay a bare `createInertiaApp()` call: the Inertia Vite plugin wraps it in the SSR server. |
| `resources/js/inertia-options.js` | Options shared by both entries: page title template, and how pages and the layout are picked from the active design's folder. |
| `resources/js/designs/<design>/` | Everything the design renders: `layouts/SiteLayout.vue`, `pages/` (one component per Inertia page, single root element), `components/`, `composables/` (`useTheme`, `useNavigation`, ...) and `lib/` helpers. |
| `resources/css/designs/<design>/` | The design's stylesheet: `app.css` (entry, imports the fonts), `tokens.css` and the component styles. |
| `docs/designs/<design>.md` | The design system of each design: tokens, type, components, accessibility notes. |
| `app/Designs/` | `SiteDesign` (the list of designs), `DesignManager` (live design, admin preview), `Props/` (props a single design adds). |
| `app/Filament/Pages/Appearance.php` | Admin page to choose the live design and preview the others. |
| `config/profile.php` | Name, roles, location, links and current role, overridable with `PROFILE_*` env variables. |
| `config/designs.php` | The default design, and each design's own copy (merged into `profile`). |

## Designs

| Design | Key | Docs |
| --- | --- | --- |
| Source: code-crafted, IBM Plex Sans + JetBrains Mono, blue | `source` | [docs/designs/source.md](designs/source.md) |
| Bento: modular cards, Plus Jakarta Sans, violet | `bento` | [docs/designs/bento.md](designs/bento.md) |
| Terrain: earthy, Bricolage Grotesque + Figtree, olive and rust | `terrain` | [docs/designs/terrain.md](designs/terrain.md) |
| Kinetic: oversized type, Unbounded + Public Sans, orange | `kinetic` | [docs/designs/kinetic.md](designs/kinetic.md) |
| Blueprint: engineering leader and product partner, teal | `blueprint` | [docs/designs/blueprint.md](designs/blueprint.md) |

**Choosing the live design.** In the admin panel, open **Appearance**, pick a design and save. The choice is stored
in the `site_settings` table (and cached), so it survives deploys. Until a design is saved, `SITE_DESIGN`
(default `source`) is used. Visitors with a page open switch to the new design on their next click: the Inertia
asset version includes the design, so the browser does a full reload and loads the new stylesheet.

**Previewing.** While signed in to the admin panel, open `/?design=<key>` (or use the Preview buttons on the
Appearance page). The design applies to your session only, and a bar at the bottom of the page shows it.
Visitors keep seeing the live design. Choose **Exit preview** (`?design=live`) to go back.

**How designs stay separate.**
- Pages and layouts are resolved from `resources/js/designs/<design>/`, using the `design` prop. Page components
  are loaded lazily, so visitors only download the active design's pages.
- Only the active design's stylesheet is loaded, so every design can use global class names and `:root` tokens
  without clashing with the others.
- Props only one design needs are built by that design's class in `app/Designs/Props/`; copy only one design uses
  lives under its key in `config/designs.php`.

**Adding a design:** add a case to `SiteDesign`, a props class in `app/Designs/Props/`, a `config/designs.php`
entry, and the `resources/js/designs/<key>/` and `resources/css/designs/<key>/` folders.

**Removing a design:** delete its two folders, its doc, its props class, its `config/designs.php` entry and its
`SiteDesign` case, plus its test in `tests/Feature/Designs/`. Remove its font packages from `package.json` if no
other design uses them.

## Design tokens

Each design defines its colours, fonts, spacing, radii and shadows as CSS custom properties in
`resources/css/designs/<design>/tokens.css`. Components use the tokens, never raw values.

- **Light and dark:** dark values are set under `[data-theme="dark"]`, and under
  `@media (prefers-color-scheme: dark)` when the visitor hasn't picked a theme. The choice is saved in
  `localStorage.theme`, so it carries over when the design changes.
- **Contrast:** text and interactive colours must reach WCAG 2.2 AA (4.5:1 for text, 3:1 for UI and large text)
  in both themes.
- **Motion:** every animation is disabled under `prefers-reduced-motion: reduce`.

## Accessibility checklist

- One `<h1>` per page and headings in order. Sections use `aria-labelledby`.
- Skip link to `#main`, and visible `:focus-visible` outlines.
- The menu button has `aria-expanded`/`aria-controls` and closes with Escape. The current page has `aria-current="page"`.
- The theme button has `aria-pressed` and a label that says what it does.
- Images have `alt` text (empty only when decorative). External links say they open a new tab.
- Interactive targets are at least 24×24 px.

## Running it

With Lando:

```sh
lando composer install
lando npm install
lando build        # client + SSR bundles
lando ssr          # SSR server, keep it running (optional: without it pages render client-side)
```

During development, `lando npm run dev` starts Vite with hot reload (SSR is handled by the Vite plugin).

Environment variables (see `.env.example`): `INERTIA_SSR_ENABLED`, `INERTIA_SSR_URL` (default
`http://127.0.0.1:13714`), `SITE_DESIGN` (the design used until one is chosen in the admin panel) and the
`PROFILE_*` values.

## Deploying (Laravel Cloud)

- Build command: `npm ci && npm run build` (Node 24, from `.nvmrc`).
- Turn on **Use Inertia SSR** in the App compute cluster settings, or set `INERTIA_SSR_ENABLED=false` to render on
  the client only. The build command above already builds the SSR bundle.
- Run the migrations on deploy (they create the `site_settings` table used by the Appearance page).
