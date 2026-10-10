import type { Hobby } from '@core/entities/hobby';
import { describe, expect, it } from 'vitest';
import { hobbyCards, leadHobby } from './cards';

const hobby = (id: number, coverImgUrl: string | null = null): Hobby => ({ id, title: `Hobby ${id}`, description: null, coverImgUrl });

describe('hobbyCards', () => {
    it('puts two halves first, then full-width split cards, without repeating the lead photo', () => {
        const hobbies = [hobby(1, '/a.jpg'), hobby(2, '/b.jpg'), hobby(3)];
        const cards = hobbyCards(hobbies, leadHobby(hobbies));

        expect(cards.map((card) => [card.number, card.span, card.layout, card.showImage])).toEqual([
            ['01', 6, 'stacked', false],
            ['02', 6, 'stacked', true],
            ['03', 12, 'split', false],
        ]);
    });

    it('makes a single hobby full width', () => {
        expect(hobbyCards([hobby(1)], null)[0]?.span).toBe(12);
    });
});
