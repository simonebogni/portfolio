import type { Component, DefineComponent } from 'vue';

/** The design used when a page arrives without one (it always has one in practice). */
export const FALLBACK_DESIGN = 'source';

/** The part of an Inertia page object the resolvers read. */
export interface PageLike {
    props?: Record<string, unknown>;
}

export type ModuleLoader = () => Promise<unknown>;

/** Where the designs live, relative to app/inertia (the keys of import.meta.glob are relative paths). */
export const DESIGNS_DIR = '../../designs';

/**
 * The FSD slice folder of an Inertia page component: "SoftSkills" → "soft-skills".
 */
export function sliceName(component: string): string {
    return component.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
}

/**
 * Keeps track of the active design. Inertia passes the page to `resolve` and `layout`; when a call
 * comes without one, the design of the previous page is used.
 */
export function createDesignTracker(fallback = FALLBACK_DESIGN): (page?: PageLike) => string {
    let current = fallback;

    return (page) => {
        const design = page?.props?.['design'];

        if (typeof design === 'string' && design !== '') {
            current = design;
        }

        return current;
    };
}

/** The module of a design's page: its FSD slice's public API (pages/<slice>/index.ts). */
export function pageModuleKey(design: string, component: string): string {
    return `${DESIGNS_DIR}/${design}/pages/${sliceName(component)}/index.ts`;
}

/** The module of a design's site layout: its FSD app layer (app/index.ts). */
export function layoutModuleKey(design: string): string {
    return `${DESIGNS_DIR}/${design}/app/index.ts`;
}

/** The default export of a page module (a page slice's index.ts re-exports the page as default). */
export function defaultExport(module: unknown): DefineComponent {
    const value = (module as { default?: unknown }).default ?? module;

    return value as DefineComponent;
}

/** Loads the page component of `component` for `design` from the globbed page modules. */
export async function resolvePage(modules: Record<string, ModuleLoader>, design: string, component: string): Promise<DefineComponent> {
    const load = modules[pageModuleKey(design, component)];

    if (load === undefined) {
        throw new Error(`Page not found: ${component} (design "${design}")`);
    }

    return defaultExport(await load());
}

/** The site layout of `design` (exported as `Layout` by the design's app/index.ts) from the eagerly globbed modules. */
export function resolveLayout(modules: Record<string, unknown>, design: string): Component | undefined {
    const module = modules[layoutModuleKey(design)] as { Layout?: Component } | undefined;

    return module?.Layout;
}
