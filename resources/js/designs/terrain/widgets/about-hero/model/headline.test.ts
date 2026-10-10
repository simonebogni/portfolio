import { describe, expect, it } from 'vitest';
import { firstNameOf, markLastWord } from './headline';

describe('markLastWord', () => {
    it('splits off the last word and its final punctuation', () => {
        expect(markLastWord(' a full-stack developer who loves taking ideas to reality. ')).toEqual({
            lead: 'a full-stack developer who loves taking ideas to ',
            mark: 'reality',
            end: '.',
        });
        expect(markLastWord('builder')).toEqual({ lead: '', mark: 'builder', end: '' });
    });

    it('is null without a headline', () => {
        expect(markLastWord('')).toBeNull();
        expect(markLastWord(null)).toBeNull();
    });
});

describe('firstNameOf', () => {
    it('takes the first word', () => {
        expect(firstNameOf('Simone Bogni')).toBe('Simone');
    });
});
