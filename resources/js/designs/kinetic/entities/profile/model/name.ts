export interface NameParts {
    /** Every word but the last ("" for a one-word name). */
    first: string;
    /** The last word with a full stop, set in orange. */
    last: string;
}

/** "Simone Bogni" → { first: "Simone", last: "Bogni." }: the hero sets the last word in orange. */
export function nameParts(name: string): NameParts {
    const words = name.trim().split(/\s+/);
    const last = words.pop();

    return { first: words.join(' '), last: `${last}.` };
}
