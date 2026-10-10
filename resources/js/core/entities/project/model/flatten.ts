import type { ProjectCategory, ProjectInCategory } from './types';

/** Every project of every category, in category order, each with its category. */
export function flattenProjects(categories: readonly ProjectCategory[]): ProjectInCategory[] {
    return categories.flatMap((category) => category.items.map((project) => ({ project, category })));
}

/** The number of projects in all categories. */
export function countProjects(categories: readonly ProjectCategory[]): number {
    return categories.reduce((sum, category) => sum + category.items.length, 0);
}
