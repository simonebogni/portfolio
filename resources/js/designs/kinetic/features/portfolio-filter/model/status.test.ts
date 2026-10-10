import { describe, expect, it } from 'vitest';
import { filterStatus } from './status';

describe('filterStatus', () => {
    it('announces the number of projects shown, and the category when one is selected', () => {
        expect(filterStatus(12, true, 'All')).toBe('Showing all 12 projects');
        expect(filterStatus(1, false, 'Web applications')).toBe('Showing 1 project in Web applications');
        expect(filterStatus(3, false, 'Projects in Java')).toBe('Showing 3 projects in Projects in Java');
    });
});
