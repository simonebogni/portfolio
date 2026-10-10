/** The hero headline, split so its last word can be underlined like a marker stroke. */
export interface MarkedHeadline {
    lead: string;
    mark: string;
    end: string;
}

/** "a developer who loves ideas." → { lead: "a developer who loves ", mark: "ideas", end: "." }; null when empty. */
export function markLastWord(headline: string | null | undefined): MarkedHeadline | null {
    const text = (headline ?? '').trim();
    const match = text.match(/^(.*\s)?(\S+?)([.!?]?)$/s);

    return match ? { lead: match[1] ?? '', mark: match[2] ?? '', end: match[3] ?? '' } : null;
}

/** "Simone Bogni" → "Simone" */
export function firstNameOf(name: string): string {
    return name.split(' ')[0] ?? '';
}
