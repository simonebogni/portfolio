/**
 * Helpers for the editable copy in config/profile.php (shared as the `profile` prop).
 */

/** Replaces {team_size}, {title}, {company} and {location} with values from the profile. */
export function fillTemplate(text, profile) {
    if (!text) {
        return '';
    }

    const role = profile?.current_role ?? {};
    const values = {
        team_size: role.team_size,
        title: role.title,
        company: role.company,
        location: profile?.location,
    };

    return String(text).replace(/\{(\w+)\}/g, (match, key) => (values[key] ?? '') === '' ? match : String(values[key]));
}

/**
 * Splits "Text with *emphasis*" into segments: [{ text, em: false }, { text: 'emphasis', em: true }].
 */
export function splitEmphasis(text) {
    return String(text ?? '')
        .split(/(\*[^*]+\*)/)
        .filter(Boolean)
        .map((part) => (part.startsWith('*') && part.endsWith('*') ? { text: part.slice(1, -1), em: true } : { text: part, em: false }));
}

/** Removes the *emphasis* markers, for plain-text uses (titles, labels). */
export function stripEmphasis(text) {
    return String(text ?? '').replace(/\*([^*]+)\*/g, '$1');
}

/** True when the owner still has to fill the value in: it contains a [BRACKETED] placeholder. */
export function isPlaceholder(...values) {
    return values.some((value) => typeof value === 'string' && /\[[^\]]+\]/.test(value));
}

/** The first sentence of a longer description (or the whole text when it is short). */
export function firstSentence(text, maxLength = 160) {
    const clean = String(text ?? '').replace(/\s+/g, ' ').trim();
    const match = clean.match(/^.+?[.!?](?=\s|$)/);
    const sentence = match ? match[0] : clean;

    if (sentence.length <= maxLength) {
        return sentence;
    }

    return `${sentence.slice(0, maxLength).replace(/\s+\S*$/, '')}…`;
}

/** 1 → "i", 4 → "iv": small roman numerals used as decorative counters. */
export function toRoman(value) {
    const numerals = [
        [10, 'x'],
        [9, 'ix'],
        [5, 'v'],
        [4, 'iv'],
        [1, 'i'],
    ];
    let rest = value;
    let out = '';

    for (const [amount, numeral] of numerals) {
        while (rest >= amount) {
            out += numeral;
            rest -= amount;
        }
    }

    return out;
}

/** 1 → "01" */
export function padNumber(value) {
    return String(value).padStart(2, '0');
}
