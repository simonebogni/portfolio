const SMALL_WORDS = new Set(['a', 'an', 'and', 'of', 'the', 'with', 'for', 'in', 'on', 'to']);

/**
 * Up to `max` initials for a monogram: "Interactive CV and Portfolio" → "ICP", "FaceDoor" → "FD".
 * Small words (and, of, the...) and words starting with punctuation are skipped.
 */
export function monogram(value: string, max = 3): string {
    const words = String(value)
        .split(/[\s\-–—_/]+/)
        .filter((word) => /^[\p{L}\p{N}]/u.test(word) && !SMALL_WORDS.has(word.toLowerCase()));
    const [only] = words;

    if (words.length === 1 && only !== undefined) {
        // One word: its capitals ("WatchNeighbors" → "WN"), or its first two letters ("Treemap" → "Tr").
        const capitals = only.match(/\p{Lu}/gu) ?? [];

        return capitals.length > 1 ? capitals.slice(0, 2).join('') : only.slice(0, 2).replace(/^./, (c) => c.toUpperCase());
    }

    return words
        .slice(0, max)
        .map((word) => word.charAt(0).toUpperCase())
        .join('');
}
