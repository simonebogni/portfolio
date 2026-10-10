/**
 * The polite live-region text after filtering: "Showing all 5 projects", or
 * "Showing 2 projects: Web applications" for one category (`category` is null for "All").
 */
export function filterStatus(count: number, category: string | null | undefined, isAll: boolean): string {
    const noun = count === 1 ? 'project' : 'projects';

    return isAll ? `Showing all ${count} ${noun}` : `Showing ${count} ${noun}: ${category}`;
}
