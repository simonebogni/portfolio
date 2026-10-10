/** Small words left out of a monogram. */
const MINOR_WORD = /^(and|of|the|with|in)$/i;

/**
 * Up to three letters that stand for a title: "Interactive CV and Portfolio" → "ICP", "ItalianPSQ" → "PSQ".
 * Kinetic's own rule (it differs from Terrain's): a single camel-cased word keeps its last capitals,
 * several words give their initials, anything else its first three letters.
 */
export function monogram(value: string | null | undefined): string {
    const title = String(value ?? '').trim();
    const capitals = title.replace(/[^A-Z]/g, '');

    if (!title.includes(' ') && capitals.length >= 2) {
        return capitals.slice(-3);
    }

    const words = title.split(/[\s-]+/).filter((word) => /^[A-Za-z0-9]/.test(word) && !MINOR_WORD.test(word));

    if (words.length > 1) {
        return words
            .slice(0, 3)
            .map((word) => word.charAt(0))
            .join('')
            .toUpperCase();
    }

    return title.slice(0, 3).toUpperCase();
}

/**
 * The letters of the header brand: the first letter of every word of the name, at most three, in capitals.
 * "Simone Bogni" → "SB". Unlike core's `initials` it keeps a third word ("Anna Maria Rossi" → "AMR").
 */
export function brandInitials(name: string | null | undefined): string {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .map((part) => part.charAt(0))
        .join('')
        .slice(0, 3)
        .toUpperCase();
}
