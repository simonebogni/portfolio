import { describe, expect, it } from 'vitest';
import { filterStatus } from './status';

describe('filterStatus', () => {
    it('words the live-region announcement', () => {
        expect(filterStatus(3, true, 'Web applications')).toBe('Showing 3 projects in all categories.');
        expect(filterStatus(1, false, 'Web applications')).toBe('Showing 1 project in Web applications.');
        expect(filterStatus(0, false, undefined)).toBe('Showing 0 projects in this category.');
    });
});
