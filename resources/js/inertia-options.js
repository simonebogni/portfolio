import SiteLayout from './layouts/SiteLayout.vue';

/**
 * Options shared by the browser (app.js) and the server renderer (ssr.js).
 */
export default {
    title: (title) => (title ? `${title} · Simone Bogni` : 'Simone Bogni · Tech Lead & full-stack developer'),
    layout: () => SiteLayout,
};
