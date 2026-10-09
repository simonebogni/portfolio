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

/** 3 → "03": two-digit index used by the numbered lists. */
export function pad2(value) {
    return String(value).padStart(2, '0');
}

/** The last four-digit year in a free-text period, e.g. "October 2012 - December 2020" → "2020". */
export function lastYearIn(value) {
    const years = String(value ?? '').match(/\b(19|20)\d{2}\b/g);

    return years ? years[years.length - 1] : '';
}

/** "Hackathon 2019 - 2nd place" → "#2"; null when the text names no placing. */
export function placeIn(value) {
    const match = String(value ?? '').match(/\b(\d+)(?:st|nd|rd|th)\s+place\b/i);

    return match ? `#${match[1]}` : null;
}

/** Up to three letters that stand for a title: "Interactive CV and Portfolio" → "ICP", "ItalianPSQ" → "PSQ". */
export function monogram(value) {
    const title = String(value ?? '').trim();
    const capitals = title.replace(/[^A-Z]/g, '');

    if (!title.includes(' ') && capitals.length >= 2) {
        return capitals.slice(-3);
    }

    const words = title.split(/[\s-]+/).filter((word) => /^[A-Za-z0-9]/.test(word) && !/^(and|of|the|with|in)$/i.test(word));

    if (words.length > 1) {
        return words
            .slice(0, 3)
            .map((word) => word[0])
            .join('')
            .toUpperCase();
    }

    return title.slice(0, 3).toUpperCase();
}

/** True for absolute http(s) links. */
export function isExternal(href) {
    return /^https?:\/\//i.test(String(href ?? ''));
}
