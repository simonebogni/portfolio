const monthYear = new Intl.DateTimeFormat('en', { month: 'short', year: 'numeric', timeZone: 'UTC' });

/** Parses "YYYY-MM" or "YYYY-MM-DD" into a UTC date, or returns null. */
function parse(value) {
    if (!value) {
        return null;
    }

    const [year, month = '01', day = '01'] = String(value).slice(0, 10).split('-');
    const date = new Date(Date.UTC(Number(year), Number(month) - 1, Number(day)));

    return Number.isNaN(date.getTime()) ? null : date;
}

/** "2020-06" → "Jun 2020" */
export function formatMonthYear(value) {
    const date = parse(value);

    return date ? monthYear.format(date) : '';
}

/** "2020-06-01" → "2020" */
export function formatYear(value) {
    const date = parse(value);

    return date ? String(date.getUTCFullYear()) : '';
}

/** A work period such as "Jun 2020 – Nov 2020", or "Jun 2020 – present" for current roles. */
export function formatPeriod({ startDate, endDate, current, period }) {
    const start = formatMonthYear(startDate);

    if (!start) {
        return period ?? '';
    }

    return `${start} – ${current ? 'present' : formatMonthYear(endDate)}`;
}

/** Lowercase, hyphenated identifier usable in ids and anchors. */
export function slugify(value) {
    return String(value)
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
}

const SMALL_WORDS = new Set(['a', 'an', 'and', 'of', 'the', 'with', 'for', 'in', 'on', 'to']);

/** Up to three initials for a monogram: "Interactive CV and Portfolio" → "ICP", "FaceDoor" → "FD". */
export function monogram(value, max = 3) {
    const words = String(value)
        .split(/[\s\-–—_/]+/)
        .filter((word) => /^[\p{L}\p{N}]/u.test(word) && !SMALL_WORDS.has(word.toLowerCase()));

    if (words.length === 1) {
        // One word: its capitals ("WatchNeighbors" → "WN"), or its first two letters ("Treemap" → "Tr").
        const capitals = words[0].match(/\p{Lu}/gu) ?? [];

        return capitals.length > 1 ? capitals.slice(0, 2).join('') : words[0].slice(0, 2).replace(/^./, (c) => c.toUpperCase());
    }

    return words
        .slice(0, max)
        .map((word) => word[0].toUpperCase())
        .join('');
}

/** Splits plain text with line breaks into trimmed, non-empty paragraphs. */
export function paragraphs(value) {
    return String(value ?? '')
        .split(/\r?\n/)
        .map((line) => line.trim())
        .filter(Boolean);
}

/** Every four-digit year in a free-text period: "October 2012 - December 2020" → "2012–2020". */
export function yearRange(value) {
    const years = String(value ?? '').match(/\b(19|20)\d{2}\b/g) ?? [];

    if (years.length === 0) {
        return '';
    }

    const first = years[0];
    const last = years[years.length - 1];

    return first === last ? first : `${first}–${last}`;
}

/** "3 projects", "1 project". */
export function pluralize(count, singular, plural = `${singular}s`) {
    return `${count} ${count === 1 ? singular : plural}`;
}

/** "'20" for a date such as "2020-06". */
export function shortYear(value) {
    const year = formatYear(value);

    return year ? `’${year.slice(2)}` : '';
}
