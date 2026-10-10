import type { ProjectCategory } from '@core/entities/project';
import { describe, expect, it } from 'vitest';
import { ref } from 'vue';
import { ALL, usePortfolioFilter } from './usePortfolioFilter';

function project(id: number, title: string) {
    return { id, slug: `p${id}`, title, subtitle: null, description: null, liveUrl: null, gitRepoUrl: null, coverImgUrl: null, date: null, images: [], tags: [] };
}

const categories: ProjectCategory[] = [
    { id: 1, name: 'webapps', title: 'Web applications', items: [project(1, 'A'), project(2, 'B')] },
    { id: 7, name: 'java', title: 'Projects in Java', items: [project(3, 'C')] },
];

describe('usePortfolioFilter', () => {
    it('starts on "All" with every project and an option per category', () => {
        const filter = usePortfolioFilter(categories);

        expect(filter.selected.value).toBe(ALL);
        expect(filter.isAll.value).toBe(true);
        expect(filter.total.value).toBe(3);
        expect(filter.options.value).toEqual([
            { value: 'all', label: 'All', count: 3 },
            { value: 'webapps', label: 'Web applications', count: 2 },
            { value: 'java', label: 'Projects in Java', count: 1 },
        ]);
        expect(filter.visibleProjects.value.map(({ project: p, category }) => `${category.name}:${p.title}`)).toEqual(['webapps:A', 'webapps:B', 'java:C']);
    });

    it('filters by category name or id', () => {
        const byName = usePortfolioFilter(categories);
        byName.select('java');

        expect(byName.isAll.value).toBe(false);
        expect(byName.selectedOption.value?.label).toBe('Projects in Java');
        expect(byName.visibleCategories.value.map((category) => category.id)).toEqual([7]);

        const byId = usePortfolioFilter(categories, { key: 'id', allLabel: 'All projects' });
        expect(byId.options.value[0]).toEqual({ value: 'all', label: 'All projects', count: 3 });
        byId.select('1');
        expect(byId.visibleProjects.value).toHaveLength(2);
    });

    it('follows reactive categories', () => {
        const source = ref<ProjectCategory[]>([]);
        const filter = usePortfolioFilter(source);

        expect(filter.total.value).toBe(0);
        source.value = categories;
        expect(filter.total.value).toBe(3);
    });
});
