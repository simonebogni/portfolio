import { flattenProjects, type ProjectCategory, type ProjectInCategory } from '@core/entities/project';
import { computed, type ComputedRef, type MaybeRefOrGetter, type Ref, ref, toValue } from 'vue';

/** The value of the "All" filter option. */
export const ALL = 'all';

export interface FilterOption {
    /** `ALL`, or the category's key (see `key` below). */
    value: string;
    label: string;
    count: number;
}

export interface PortfolioFilterOptions {
    /** Which category field identifies an option: its id (as a string) or its machine name. Default: 'name'. */
    key?: 'id' | 'name';
    /** Label of the option showing every project. Default: 'All'. */
    allLabel?: string;
}

export interface UsePortfolioFilter {
    selected: Ref<string>;
    /** "All" first, then one option per category, each with its number of projects. */
    options: ComputedRef<FilterOption[]>;
    selectedOption: ComputedRef<FilterOption | undefined>;
    isAll: ComputedRef<boolean>;
    select: (value: string) => void;
    /** The categories the selection shows, in order. */
    visibleCategories: ComputedRef<ProjectCategory[]>;
    /** The projects the selection shows, in order, each with its category. */
    visibleProjects: ComputedRef<ProjectInCategory[]>;
    total: ComputedRef<number>;
}

/**
 * Filtering the portfolio by category. Designs render the options and announce the result in
 * their own words; the state lives here.
 */
export function usePortfolioFilter(categories: MaybeRefOrGetter<readonly ProjectCategory[]>, options: PortfolioFilterOptions = {}): UsePortfolioFilter {
    const keyOf = (category: ProjectCategory): string => (options.key === 'id' ? String(category.id) : category.name);
    const selected = ref(ALL);

    const all = computed(() => toValue(categories));
    const projects = computed(() => flattenProjects(all.value));
    const total = computed(() => projects.value.length);

    const filterOptions = computed<FilterOption[]>(() => [
        { value: ALL, label: options.allLabel ?? 'All', count: total.value },
        ...all.value.map((category) => ({ value: keyOf(category), label: category.title, count: category.items.length })),
    ]);

    const isAll = computed(() => selected.value === ALL);

    const visibleCategories = computed(() => (isAll.value ? [...all.value] : all.value.filter((category) => keyOf(category) === selected.value)));

    return {
        selected,
        options: filterOptions,
        selectedOption: computed(() => filterOptions.value.find((option) => option.value === selected.value)),
        isAll,
        select: (value) => {
            selected.value = value;
        },
        visibleCategories,
        visibleProjects: computed(() => flattenProjects(visibleCategories.value)),
        total,
    };
}
