/**
 * "Interactive CV and Portfolio" → "IC"; single words keep their first two letters.
 * (Core's `initials` differs: it keeps punctuation and gives one letter for a single word.)
 */
export function monogram(title: string): string {
    const words = String(title)
        .replace(/[^\p{L}\p{N}\s-]/gu, '')
        .split(/[\s-]+/)
        .filter(Boolean);

    if (words.length === 1) {
        return (words[0] ?? '').slice(0, 2).toUpperCase();
    }

    return words
        .slice(0, 2)
        .map((word) => word.charAt(0).toUpperCase())
        .join('');
}
