import { createDesignTracker, type ModuleLoader, type PageLike, resolveLayout, resolvePage } from './resolve';

// The glob patterns must stay literal for Vite; they match DESIGNS_DIR in ./resolve.

/*
 * Options shared by the browser and the server renderer.
 *
 * Every design is its own FSD tree in resources/js/designs/<design>/. The server says which design is
 * active in the shared `design` prop; the page and the layout are picked from that design's folder.
 * Pages are loaded lazily, so a visitor only downloads the pages of the active design.
 */
const pages = import.meta.glob<unknown>('../../designs/*/pages/*/index.ts') as Record<string, ModuleLoader>;
const layouts = import.meta.glob<unknown>('../../designs/*/app/index.ts', { eager: true });

const designOf = createDesignTracker();

export const inertiaOptions = {
    title: (title: string): string => (title ? `${title} · Simone Bogni` : 'Simone Bogni · Tech Lead & full-stack developer'),
    resolve: (name: string, page?: PageLike) => resolvePage(pages, designOf(page), name),
    layout: (_name: string, page?: PageLike) => resolveLayout(layouts, designOf(page)),
};
