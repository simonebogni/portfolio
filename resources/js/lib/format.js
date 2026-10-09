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

/** 3 → "03" */
export function padNumber(value, length = 2) {
    return String(value).padStart(length, '0');
}

/** 4 → "iv" (lowercase Roman numerals, for editorial section numbers). */
export function toRoman(value) {
    const numerals = [
        [1000, 'm'], [900, 'cm'], [500, 'd'], [400, 'cd'], [100, 'c'], [90, 'xc'],
        [50, 'l'], [40, 'xl'], [10, 'x'], [9, 'ix'], [5, 'v'], [4, 'iv'], [1, 'i'],
    ];
    let rest = Math.max(0, Math.floor(Number(value) || 0));
    let result = '';

    for (const [amount, numeral] of numerals) {
        while (rest >= amount) {
            result += numeral;
            rest -= amount;
        }
    }

    return result;
}

/**
 * Splits text with *emphasised* words into parts, so templates can render the
 * emphasis without v-html: "an *idea*" → [{ text: 'an ', em: false }, { text: 'idea', em: true }].
 */
export function emphasisParts(value) {
    return String(value ?? '')
        .split(/(\*[^*]+\*)/)
        .filter(Boolean)
        .map((part) => (part.startsWith('*') && part.endsWith('*') && part.length > 2
            ? { text: part.slice(1, -1), em: true }
            : { text: part, em: false }));
}

/** Plain text with line breaks → list of non-empty paragraphs. */
export function paragraphs(value) {
    return String(value ?? '')
        .split(/\r?\n/)
        .map((line) => line.trim())
        .filter(Boolean);
}

/** "October 2012 - December 2020" → "October 2012 – December 2020" */
export function formatRange(value) {
    return String(value ?? '').replace(/\s+-\s+/g, ' – ');
}

/** Last four-digit year found in a free-text period, or ''. */
export function lastYear(value) {
    const years = String(value ?? '').match(/\b(19|20)\d{2}\b/g);

    return years ? years[years.length - 1] : '';
}
