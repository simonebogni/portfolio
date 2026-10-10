import type { Hobby } from '@core/entities/hobby';
import { pad2 } from '@core/shared/lib';

export interface HobbyCard {
    hobby: Hobby;
    /** "01" */
    number: string;
    span: number;
    layout: 'split' | 'stacked';
    showImage: boolean;
}

/** The first hobby with a photo opens the page, next to the header. */
export function leadHobby(hobbies: readonly Hobby[]): Hobby | null {
    return hobbies.find((hobby) => hobby.coverImgUrl) ?? null;
}

/**
 * Card layouts: two half-width cards (the one whose photo is already shown above
 * goes text-only), then full-width cards with the photo beside the text.
 */
export function hobbyCards(hobbies: readonly Hobby[], lead: Hobby | null): HobbyCard[] {
    return hobbies.map((hobby, index) => {
        const wide = index >= 2 || hobbies.length === 1;

        return {
            hobby,
            number: pad2(index + 1),
            span: wide ? 12 : 6,
            layout: wide ? 'split' : 'stacked',
            showImage: Boolean(hobby.coverImgUrl) && hobby.id !== lead?.id,
        };
    });
}
