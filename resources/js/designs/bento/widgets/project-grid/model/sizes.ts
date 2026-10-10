export type CardSize = 'wide' | 'half' | 'third' | 'full';

/**
 * Bento sizes for n cards, so every row is filled: a wide featured card with two
 * cards beside it, then rows of two halves or three thirds.
 */
export function sizesFor(count: number): CardSize[] {
    if (count === 1) {
        return ['full'];
    }

    if (count === 2) {
        return ['half', 'half'];
    }

    const sizes: CardSize[] = ['wide', 'third', 'third'];
    let remaining = count - 3;

    while (remaining > 0) {
        if (remaining === 1) {
            sizes.push('full');
            remaining -= 1;
        } else if (remaining === 2 || remaining === 4) {
            sizes.push('half', 'half');
            remaining -= 2;
        } else {
            sizes.push('third', 'third', 'third');
            remaining -= 3;
        }
    }

    return sizes;
}
