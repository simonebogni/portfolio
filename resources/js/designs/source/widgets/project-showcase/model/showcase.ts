import type { Project, ProjectCategory } from '@core/entities/project';

export interface FeaturedItem {
    item: Project;
    /** The title of the project's category. */
    category: string;
}

export interface ShowcaseSection extends ProjectCategory {
    /** The category's projects, without the featured one. */
    gridItems: Project[];
}

/** The first project of the selection, shown large. */
export function featuredOf(categories: readonly ProjectCategory[]): FeaturedItem | null {
    for (const category of categories) {
        const item = category.items[0];

        if (item) {
            return { item, category: category.title };
        }
    }

    return null;
}

/** The categories with projects left once the featured one is taken out of its grid. */
export function sectionsOf(categories: readonly ProjectCategory[], featured: FeaturedItem | null): ShowcaseSection[] {
    return categories
        .map((category) => ({
            ...category,
            gridItems: category.items.filter((item) => item.id !== featured?.item.id),
        }))
        .filter((category) => category.gridItems.length > 0);
}
