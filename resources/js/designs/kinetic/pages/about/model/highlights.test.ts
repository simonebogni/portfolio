import type { SkillCategory } from '@core/entities/skill';
import { describe, expect, it } from 'vitest';
import { highlights, tickerItems } from './highlights';

describe('highlights', () => {
    it('lists the non-zero counts', () => {
        expect(highlights({ projects: 12, certificates: 3, awards: 1 }, 2)).toEqual([
            { value: 12, label: 'portfolio projects' },
            { value: '3×', label: 'certifications', count: 3 },
            { value: 1, label: 'award' },
            { value: 2, label: 'spoken languages' },
        ]);
        expect(highlights({ projects: 0, certificates: 0, awards: 2 }, 0)).toEqual([{ value: 2, label: 'awards' }]);
    });
});

describe('tickerItems', () => {
    it('lists every skill once, without notes, and leaves out long names', () => {
        const categories: SkillCategory[] = [
            {
                id: 1,
                name: 'Back end',
                subcategories: [
                    { id: 1, name: 'Languages', skills: [{ id: 1, name: 'PHP' }, { id: 2, name: 'Java (past)' }] },
                    { id: 2, name: 'Other', skills: [{ id: 3, name: 'PHP' }, { id: 4, name: 'A very long skill name over the limit' }] },
                ],
            },
        ];

        expect(tickerItems(categories)).toEqual(['PHP', 'Java']);
    });
});
