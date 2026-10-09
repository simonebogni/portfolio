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

/** "Hackathon 2019 - 2nd place" → "2nd"; null when the text has no ordinal. */
export function findOrdinal(value) {
    const match = String(value ?? '').match(/\b(\d+(?:st|nd|rd|th))\b/i);

    return match ? match[1] : null;
}
