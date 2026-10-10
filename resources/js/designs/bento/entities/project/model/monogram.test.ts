import { describe, expect, it } from 'vitest';
import { monogram } from './monogram';

describe('monogram', () => {
    it('takes the first letters of the first two words', () => {
        expect(monogram('Interactive CV and Portfolio')).toBe('IC');
        expect(monogram('real-time chat')).toBe('RT');
    });

    it('keeps the first two letters of a single word', () => {
        expect(monogram('portfolio')).toBe('PO');
    });

    it('ignores punctuation', () => {
        expect(monogram('Hello, World!')).toBe('HW');
        expect(monogram('!!!')).toBe('');
    });
});
