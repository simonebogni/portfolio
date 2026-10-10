import { describe, expect, it } from 'vitest';
import { filterStatus } from './status';

describe('filterStatus', () => {
    it('announces every project', () => {
        expect(filterStatus(5, 'All', true)).toBe('Showing all 5 projects');
        expect(filterStatus(1, 'All', true)).toBe('Showing all 1 project');
    });

    it('announces one category', () => {
        expect(filterStatus(2, 'Web applications', false)).toBe('Showing 2 projects: Web applications');
        expect(filterStatus(1, 'Games', false)).toBe('Showing 1 project: Games');
    });
});
