import { describe, expect, it } from 'vitest';
import { brandInitials, monogram } from './monogram';

describe('monogram', () => {
    it('keeps the last capitals of a single camel-cased word', () => {
        expect(monogram('ItalianPSQ')).toBe('PSQ');
        expect(monogram('GitHub')).toBe('GH');
        expect(monogram('MyFancyWebApp')).toBe('FWA');
    });

    it('uses the initials of up to three words, skipping small words', () => {
        expect(monogram('Interactive CV and Portfolio')).toBe('ICP');
        expect(monogram('Game of the year')).toBe('GY');
        expect(monogram('point-of-sale terminal app')).toBe('PST');
        expect(monogram('A (beta) build')).toBe('AB');
    });

    it('falls back to the first three letters', () => {
        expect(monogram('portfolio')).toBe('POR');
        expect(monogram('  Of the  ')).toBe('OF ');
        expect(monogram('Web')).toBe('WEB');
        expect(monogram('')).toBe('');
        expect(monogram(null)).toBe('');
        expect(monogram(undefined)).toBe('');
    });
});

describe('brandInitials', () => {
    it('takes the first letter of each word, at most three', () => {
        expect(brandInitials('Simone Bogni')).toBe('SB');
        expect(brandInitials('anna maria rossi bianchi')).toBe('AMR');
        expect(brandInitials('  Cher ')).toBe('C');
        expect(brandInitials(null)).toBe('');
    });
});
