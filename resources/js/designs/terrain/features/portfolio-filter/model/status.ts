import { pluralize } from '@core/shared/lib';

/**
 * The text of the filter's live region: "Showing 3 projects in all categories." or
 * "Showing 1 project in Web applications."
 */
export function filterStatus(count: number, isAll: boolean, categoryTitle: string | undefined): string {
    const scope = isAll ? 'in all categories' : `in ${categoryTitle ?? 'this category'}`;

    return `Showing ${pluralize(count, 'project')} ${scope}.`;
}
