import { flattenProjects, type ProjectCategory, type ProjectInCategory } from '@core/entities/project';
import { ALL, usePortfolioFilter } from '@core/features/portfolio-filter';
import type { FilterChoice } from '@designs/blueprint/shared/ui';
import { computed, type ComputedRef, type MaybeRefOrGetter, type Ref, toValue } from 'vue';

/** The value of the "Leadership" option, which shows only the featured case study. */
export const LEADERSHIP = 'leadership';

export interface CaseStudyFilter {
    selected: Ref<string>;
    /** "All", "Leadership" (when there is a featured case study), then one option per category. */
    options: ComputedRef<FilterChoice[]>;
    /** Whether the featured case study is shown: with "All" or "Leadership". */
    showFeatured: ComputedRef<boolean>;
    /** Projects shown as full case cards: the first category with "All", else every visible project. */
    cards: ComputedRef<ProjectInCategory[]>;
    /** Projects listed compactly under "More projects": the other categories, with "All" only. */
    more: ComputedRef<ProjectInCategory[]>;
    resultCount: ComputedRef<number>;
    /** The live-region text, e.g. "Showing 3 projects in Web applications". */
    resultLabel: ComputedRef<string>;
}

/**
 * The case study filter: core's portfolio filter (categories keyed by id) plus a "Leadership"
 * option for the featured case study.
 */
export function useCaseStudyFilter(categories: MaybeRefOrGetter<readonly ProjectCategory[]>, hasFeatured: MaybeRefOrGetter<boolean>): CaseStudyFilter {
    const filter = usePortfolioFilter(categories, { key: 'id' });
    const { selected, isAll, visibleCategories } = filter;

    const options = computed<FilterChoice[]>(() => [
        { value: ALL, label: 'All' },
        ...(toValue(hasFeatured) ? [{ value: LEADERSHIP, label: 'Leadership' }] : []),
        ...filter.options.value.filter((option) => option.value !== ALL).map(({ value, label }) => ({ value, label })),
    ]);

    const showFeatured = computed(() => toValue(hasFeatured) && (isAll.value || selected.value === LEADERSHIP));

    const cards = computed(() => flattenProjects(isAll.value ? visibleCategories.value.slice(0, 1) : visibleCategories.value));
    const more = computed(() => (isAll.value ? flattenProjects(visibleCategories.value.slice(1)) : []));

    const resultCount = computed(() => cards.value.length + more.value.length + (showFeatured.value ? 1 : 0));

    const resultLabel = computed(() => {
        const option = options.value.find((candidate) => candidate.value === selected.value);
        const noun = resultCount.value === 1 ? 'project' : 'projects';

        return isAll.value ? `Showing all ${resultCount.value} ${noun}` : `Showing ${resultCount.value} ${noun} in ${option?.label}`;
    });

    return { selected, options, showFeatured, cards, more, resultCount, resultLabel };
}
