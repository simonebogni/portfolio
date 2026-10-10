const monthYear = new Intl.DateTimeFormat('en', { month: 'short', year: 'numeric', timeZone: 'UTC' });

/** A date as the server sends it: "YYYY", "YYYY-MM" or "YYYY-MM-DD" (time is ignored), or nothing. */
export type DateInput = string | null | undefined;

/** Parses "YYYY-MM" or "YYYY-MM-DD" into a UTC date, or returns null. */
export function parseDate(value: DateInput): Date | null {
    if (!value) {
        return null;
    }

    const [year = '', month = '01', day = '01'] = String(value).slice(0, 10).split('-');
    const date = new Date(Date.UTC(Number(year), Number(month) - 1, Number(day)));

    return Number.isNaN(date.getTime()) ? null : date;
}

/** "2020-06" → "Jun 2020" */
export function formatMonthYear(value: DateInput): string {
    const date = parseDate(value);

    return date ? monthYear.format(date) : '';
}

/** "2020-06-01" → "2020" */
export function formatYear(value: DateInput): string {
    const date = parseDate(value);

    return date ? String(date.getUTCFullYear()) : '';
}

export interface PeriodInput {
    startDate?: DateInput;
    endDate?: DateInput;
    current?: boolean;
    period?: string | null;
}

/** A work period such as "Jun 2020 – Nov 2020", or "Jun 2020 – present" for current roles. */
export function formatPeriod({ startDate, endDate, current, period }: PeriodInput): string {
    const start = formatMonthYear(startDate);

    if (!start) {
        return period ?? '';
    }

    return `${start} – ${current ? 'present' : formatMonthYear(endDate)}`;
}

const YEAR = /\b(19|20)\d{2}\b/g;

/** Every four-digit year in a free-text period: "October 2012 - December 2020" → "2012–2020". */
export function yearRange(value: string | null | undefined): string {
    const years = String(value ?? '').match(YEAR) ?? [];
    const first = years[0];
    const last = years[years.length - 1];

    if (first === undefined || last === undefined) {
        return '';
    }

    return first === last ? first : `${first}–${last}`;
}

/** The last four-digit year in a free-text period, e.g. "October 2012 - December 2020" → "2020". */
export function lastYearIn(value: string | null | undefined): string {
    const years = String(value ?? '').match(YEAR);

    return years?.[years.length - 1] ?? '';
}

/** "'20" for a date such as "2020-06". */
export function shortYear(value: DateInput): string {
    const year = formatYear(value);

    return year ? `’${year.slice(2)}` : '';
}
