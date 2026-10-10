import { describe, expect, it } from 'vitest';
import { iconFor, spanFor } from './tiles';

describe('iconFor', () => {
    it('picks an icon by keyword, else by position', () => {
        expect(iconFor('Team work', 0)).toBe('people');
        expect(iconFor('Curiosity', 0)).toBe('spark');
        expect(iconFor('Curiosity', 10)).toBe('cap');
    });
});

describe('spanFor', () => {
    it('lays out thirds, then halves, with a last odd tile full width', () => {
        expect([0, 1, 2, 3, 4, 5, 6].map((index) => spanFor(index, 7))).toEqual([4, 4, 4, 4, 6, 6, 12]);
        expect([4, 5].map((index) => spanFor(index, 6))).toEqual([6, 6]);
    });
});
