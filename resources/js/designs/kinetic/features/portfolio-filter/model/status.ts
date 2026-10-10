/**
 * What the live region announces after filtering: "Showing all 12 projects",
 * "Showing 1 project in Web applications".
 */
export function filterStatus(count: number, isAll: boolean, categoryLabel: string | undefined): string {
    const noun = count === 1 ? 'project' : 'projects';

    return isAll ? `Showing all ${count} ${noun}` : `Showing ${count} ${noun} in ${categoryLabel}`;
}
