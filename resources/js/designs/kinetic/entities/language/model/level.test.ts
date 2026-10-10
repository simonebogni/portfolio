import type { Language } from '@core/entities/language';
import { describe, expect, it } from 'vitest';
import { languageLevel } from './level';

const language = (overrides: Partial<Language>): Language => ({
    id: 1,
    name: 'English',
    rating: 4.5,
    ratingMeaning: 'Proficient',
    speaking: 'Fluent',
    isNative: false,
    certificateLevel: null,
    ...overrides,
});

describe('languageLevel', () => {
    it('reads native, then speaking, then the rating, with the certificate', () => {
        expect(languageLevel(language({ isNative: true }))).toBe('Native');
        expect(languageLevel(language({ certificateLevel: 'C1' }))).toBe('Fluent · C1');
        expect(languageLevel(language({ speaking: '' }))).toBe('Proficient');
    });
});
