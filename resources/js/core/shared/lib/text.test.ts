import { describe, expect, it } from 'vitest';
import { isExternal } from './url';
import { emphasisSegments, findOrdinal, initials, isPlaceholder, pad2, paragraphs, placeIn, pluralize, slugify } from './text';

describe('text helpers', () => {
    it('slugifies, pluralizes and pads', () => {
        expect(slugify('Web applications & more')).toBe('web-applications-more');
        expect(pluralize(1, 'project')).toBe('1 project');
        expect(pluralize(3, 'project')).toBe('3 projects');
        expect(pluralize(2, 'child', 'children')).toBe('2 children');
        expect(pad2(3)).toBe('03');
        expect(pad2(12)).toBe('12');
    });

    it('splits paragraphs and makes initials', () => {
        expect(paragraphs(' First \r\n\nSecond ')).toEqual(['First', 'Second']);
        expect(paragraphs(null)).toEqual([]);
        expect(initials('Simone Bogni')).toBe('SB');
        expect(initials('')).toBe('');
    });

    it('finds ordinals and placings', () => {
        expect(findOrdinal('Hackathon 2019 - 2nd place')).toBe('2nd');
        expect(findOrdinal('Hackathon 2019')).toBeNull();
        expect(placeIn('Hackathon 2019 - 2nd place')).toBe('#2');
        expect(placeIn('Hackathon 2019 - 2nd')).toBeNull();
    });

    it('splits emphasis and spots placeholders', () => {
        expect(emphasisSegments('I lead *15 developers* daily')).toEqual([
            { text: 'I lead ', em: false },
            { text: '15 developers', em: true },
            { text: ' daily', em: false },
        ]);
        expect(isPlaceholder('[CURRENT COMPANY]')).toBe(true);
        expect(isPlaceholder('Acme [beta]')).toBe(false);
        expect(isPlaceholder(null)).toBe(false);
    });

    it('detects external links', () => {
        expect(isExternal('https://example.com')).toBe(true);
        expect(isExternal('/experience')).toBe(false);
        expect(isExternal(null)).toBe(false);
    });
});
