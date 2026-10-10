/**
 * Two or three letters drawn on a project cover: the initials of the first two words, else the
 * last capitals of a CamelCase name ("OpenGL" → "GL"), else the first two letters.
 */
export function monogram(title: string): string {
    const words = title.split(/[\s-]+/).filter((word) => /^[A-Za-z0-9]/.test(word));

    if (words.length > 1) {
        return words
            .slice(0, 2)
            .map((word) => word[0])
            .join('')
            .toUpperCase();
    }

    const capitals = title.replace(/[^A-Z]/g, '');

    return (capitals.length >= 2 ? capitals.slice(-3) : title.slice(0, 2)).toUpperCase();
}
