/** Lowercase, hyphenated identifier usable in ids and anchors. */
export function slugify(value: string | number): string {
    return String(value)
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
}

/** "3 projects", "1 project". */
export function pluralize(count: number, singular: string, plural = `${singular}s`): string {
    return `${count} ${count === 1 ? singular : plural}`;
}

/** 3 → "03": two-digit index used by numbered lists. */
export function pad2(value: number | string): string {
    return String(value).padStart(2, '0');
}

/** Splits plain text with line breaks into trimmed, non-empty paragraphs. */
export function paragraphs(value: string | null | undefined): string[] {
    return String(value ?? '')
        .split(/\r?\n/)
        .map((line) => line.trim())
        .filter(Boolean);
}

/** "Simone Bogni" → "SB" */
export function initials(name: string | null | undefined): string {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .slice(0, 2)
        .map((part) => part.charAt(0).toUpperCase())
        .join('');
}

/** "Hackathon 2019 - 2nd place" → "2nd"; null when the text has no ordinal. */
export function findOrdinal(value: string | null | undefined): string | null {
    const match = String(value ?? '').match(/\b(\d+(?:st|nd|rd|th))\b/i);

    return match?.[1] ?? null;
}

/** "Hackathon 2019 - 2nd place" → "#2"; null when the text names no placing. */
export function placeIn(value: string | null | undefined): string | null {
    const match = String(value ?? '').match(/\b(\d+)(?:st|nd|rd|th)\s+place\b/i);

    return match ? `#${match[1]}` : null;
}

export interface TextSegment {
    text: string;
    em: boolean;
}

/**
 * Splits "a *highlighted* text" into segments, so a template can render the emphasis without v-html.
 */
export function emphasisSegments(text: string | null | undefined): TextSegment[] {
    return String(text ?? '')
        .split('*')
        .map((part, index) => ({ text: part, em: index % 2 === 1 }))
        .filter((segment) => segment.text !== '');
}

/** True for owner-facing placeholders such as "[CURRENT COMPANY]". */
export function isPlaceholder(text: unknown): boolean {
    return typeof text === 'string' && /^\s*\[.*\]\s*$/s.test(text);
}
