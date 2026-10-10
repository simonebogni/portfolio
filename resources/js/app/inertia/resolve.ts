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

/**
 * Where a design's page component may live, in order of preference:
 * the FSD slice (pages/<slice>/index.ts) or the pre-FSD file (pages/<Name>.vue).
 */
export function pageModuleKeys(design: string, component: string): string[] {
    return [`${DESIGNS_DIR}/${design}/pages/${sliceName(component)}/index.ts`, `${DESIGNS_DIR}/${design}/pages/${component}.vue`];
}

/** Where a design's site layout may live: the FSD app layer, or the pre-FSD layouts folder. */
export function layoutModuleKeys(design: string): string[] {
    return [`${DESIGNS_DIR}/${design}/app/index.ts`, `${DESIGNS_DIR}/${design}/layouts/SiteLayout.vue`];
}

/** The default export of a page module (an FSD slice's index.ts re-exports the page as default). */
export function defaultExport(module: unknown): DefineComponent {
    const value = (module as { default?: unknown }).default ?? module;

    return value as DefineComponent;
}

/** Loads the page component of `component` for `design` from the globbed page modules. */
export async function resolvePage(modules: Record<string, ModuleLoader>, design: string, component: string): Promise<DefineComponent> {
    const key = pageModuleKeys(design, component).find((candidate) => candidate in modules);

    if (key === undefined) {
        throw new Error(`Page not found: ${component} (design "${design}")`);
    }

    return defaultExport(await modules[key]!());
}

/**
 * The site layout of `design` from the eagerly globbed layout modules: an FSD app index exports it as
 * `Layout`, a pre-FSD SiteLayout.vue as its default export.
 */
export function resolveLayout(modules: Record<string, unknown>, design: string): Component | undefined {
    for (const key of layoutModuleKeys(design)) {
        const module = modules[key] as { Layout?: Component; default?: Component } | undefined;

        if (module) {
            return module.Layout ?? module.default;
        }
    }

    return undefined;
}
