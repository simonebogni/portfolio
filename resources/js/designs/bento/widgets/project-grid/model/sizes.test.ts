import { describe, expect, it } from 'vitest';
import { sizesFor } from './sizes';

describe('sizesFor', () => {
    it('fills one or two cards across the row', () => {
        expect(sizesFor(1)).toEqual(['full']);
        expect(sizesFor(2)).toEqual(['half', 'half']);
    });

    it('starts with a wide card and two thirds', () => {
        expect(sizesFor(3)).toEqual(['wide', 'third', 'third']);
    });

    it('fills every following row', () => {
        expect(sizesFor(4)).toEqual(['wide', 'third', 'third', 'full']);
        expect(sizesFor(5)).toEqual(['wide', 'third', 'third', 'half', 'half']);
        expect(sizesFor(6)).toEqual(['wide', 'third', 'third', 'third', 'third', 'third']);
        expect(sizesFor(7)).toEqual(['wide', 'third', 'third', 'half', 'half', 'half', 'half']);
        expect(sizesFor(8)).toEqual(['wide', 'third', 'third', 'third', 'third', 'third', 'half', 'half']);
    });

    it('gives one size per card', () => {
        for (let count = 1; count <= 20; count += 1) {
            expect(sizesFor(count)).toHaveLength(count);
        }
    });
});
