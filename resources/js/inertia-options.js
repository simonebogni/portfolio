/**
 * Options shared by the browser (app.js) and the server renderer (ssr.js).
 *
 * Every design lives in resources/js/designs/<design>/ with its own layouts,
 * pages, components, composables and helpers. The server says which design is
 * active in the shared `design` prop; pages and the layout are picked from
 * that design's folder. Page components are loaded lazily, so a visitor only
 * downloads the pages of the active design.
 */
const pages = import.meta.glob('./designs/*/pages/*.vue');
const layouts = import.meta.glob('./designs/*/layouts/SiteLayout.vue', { eager: true, import: 'default' });

const FALLBACK_DESIGN = 'source';
let lastDesign = FALLBACK_DESIGN;

function designOf(page) {
    lastDesign = page?.props?.design ?? lastDesign;

    return lastDesign;
}

export default {
    title: (title) => (title ? `${title} · Simone Bogni` : 'Simone Bogni · Tech Lead & full-stack developer'),
    resolve: async (name, page) => {
        const design = designOf(page);
        const load = pages[`./designs/${design}/pages/${name}.vue`];

        if (!load) {
            throw new Error(`Page not found: ${name} (design "${design}")`);
        }

        const module = await load();

        return module.default ?? module;
    },
    layout: (name, page) => layouts[`./designs/${designOf(page)}/layouts/SiteLayout.vue`],
};
