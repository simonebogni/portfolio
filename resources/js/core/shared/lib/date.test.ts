import { describe, expect, it } from 'vitest';
import { formatMonthYear, formatPeriod, formatYear, lastYearIn, parseDate, shortYear, yearRange } from './date';

describe('dates', () => {
    it('parses year-month and full dates in UTC, and rejects garbage', () => {
        expect(parseDate('2020-06')?.toISOString()).toBe('2020-06-01T00:00:00.000Z');
        expect(parseDate('2020-06-15 10:00:00')?.toISOString()).toBe('2020-06-15T00:00:00.000Z');
        expect(parseDate('')).toBeNull();
        expect(parseDate(null)).toBeNull();
        expect(parseDate('not a date')).toBeNull();
    });

    it('formats months, years and periods', () => {
        expect(formatMonthYear('2020-06')).toBe('Jun 2020');
        expect(formatYear('2020-06-01')).toBe('2020');
        expect(shortYear('2020-06')).toBe('’20');
        expect(formatPeriod({ startDate: '2020-06', endDate: '2020-11' })).toBe('Jun 2020 – Nov 2020');
        expect(formatPeriod({ startDate: '2020-06', current: true })).toBe('Jun 2020 – present');
        expect(formatPeriod({ period: 'Summer 2019' })).toBe('Summer 2019');
        expect(formatPeriod({})).toBe('');
    });

    it('reads years out of free-text periods', () => {
        expect(yearRange('October 2012 - December 2020')).toBe('2012–2020');
        expect(yearRange('2019')).toBe('2019');
        expect(yearRange('ongoing')).toBe('');
        expect(lastYearIn('October 2012 - December 2020')).toBe('2020');
        expect(lastYearIn(null)).toBe('');
    });
});
