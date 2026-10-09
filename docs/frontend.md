# Front end

The public site (About, Experience, Portfolio, Soft skills, Hobbies) is a Vue 3 app served through
[Inertia](https://inertiajs.com) with server-side rendering. The Filament admin panel and the auth pages are
unchanged and keep using Blade.

The visual design (Terrain) — tokens, fonts, components and accessibility notes — is documented in
[design-system.md](design-system.md).

## How a page is rendered

1. A controller in `app/Http/Controllers` loads the models and returns `Inertia::render('<Page>', $props)`.
   Props are plain arrays with camelCase keys: the Vue code never sees Eloquent models.
2. `HandleInertiaRequests` adds the shared props: `profile` (from `config/profile.php`). The About page also
   receives `highlights` (counts of portfolio items, certificates and awards).
3. `resources/views/app.blade.php` is the only Blade view for the public site. It sets the meta tags, applies
   the saved theme before the first paint, and outputs `@inertiaHead` / `@inertia`.
4. With SSR on, Laravel posts the page to the Node SSR server (`bootstrap/ssr/ssr.js`), which returns the
   rendered HTML. The browser then hydrates it with `resources/js/app.js`. If the SSR server is down, Inertia
   falls back to client-side rendering, so the site keeps working.

## Files

| Path | What it holds |
| --- | --- |
| `resources/js/app.js` / `ssr.js` | Client and SSR entry points. `ssr.js` must stay a bare `createInertiaApp()` call: the Inertia Vite plugin wraps it in the SSR server. |
| `resources/js/inertia-options.js` | Options shared by both entries: page title template and the default layout. |
| `resources/js/layouts/` | Site layout: skip link, header and navigation, theme switch, footer. |
| `resources/js/pages/` | One component per Inertia page. Each must have a single root element. |
| `resources/js/components/` | Reusable design-system components. |
| `resources/js/composables/` | `useTheme` (light/dark), `useNavigation` (menu state, current page). |
| `resources/js/lib/format.js` | Date and string helpers. |
| `resources/css/app.css` | Entry stylesheet: imports the fonts, `tokens.css`, `base.css`, `components.css`, `layout.css` and `pages.css`. |
| `config/profile.php` | Name, roles, location, hero headline and bio, links and current role, overridable with `PROFILE_*` env variables. |

## Design tokens

All colours, fonts, spacing, radii and shadows are CSS custom properties defined in
`resources/css/tokens.css` (see [design-system.md](design-system.md)). Components use the tokens, never raw values, so a theme or a redesign only changes the
token values.

- **Light and dark:** dark values are set under `[data-theme="dark"]`, and under
  `@media (prefers-color-scheme: dark)` when the visitor hasn't picked a theme. The choice is saved in
  `localStorage.theme`.
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
`http://127.0.0.1:13714`) and the `PROFILE_*` values.

## Deploying (Laravel Cloud)

- Build command: `npm ci && npm run build` (Node 24, from `.nvmrc`).
- Add a background process running `php artisan inertia:start-ssr`, or set `INERTIA_SSR_ENABLED=false` to render
  on the client only.
