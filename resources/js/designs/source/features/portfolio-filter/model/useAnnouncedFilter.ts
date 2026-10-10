import type { ProjectCategory } from '@core/entities/project';
import { ALL, type UsePortfolioFilter, usePortfolioFilter } from '@core/features/portfolio-filter';
import { pluralize } from '@core/shared/lib';
import { type MaybeRefOrGetter, type Ref, ref } from 'vue';

export interface UseAnnouncedFilter extends UsePortfolioFilter {
    /** Text of the polite status region: empty until the visitor picks a category. */
    announce: Ref<string>;
    /** Selects a category and announces the result, e.g. "Showing 2 projects in Projects in Java." */
    onFilter: (value: string) => void;
}

/** The portfolio filter (by category machine name), announcing each choice in a live region. */
export function useAnnouncedFilter(categories: MaybeRefOrGetter<readonly ProjectCategory[]>): UseAnnouncedFilter {
    const filter = usePortfolioFilter(categories, { key: 'name' });
    const announce = ref('');

    function onFilter(value: string): void {
        filter.select(value);
        const option = filter.selectedOption.value;

        if (option) {
            announce.value = `Showing ${pluralize(option.count, 'project')}${value === ALL ? '' : ` in ${option.label}`}.`;
        }
    }

    return { ...filter, announce, onFilter };
}
