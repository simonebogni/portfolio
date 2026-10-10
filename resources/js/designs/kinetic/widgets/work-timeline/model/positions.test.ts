import type { Company, WorkPosition } from '@core/entities/work';
import { describe, expect, it } from 'vitest';
import { timelinePositions, workSpan } from './positions';

const position = (id: number, startDate: string, endDate: string | null, current = false): WorkPosition => ({
    id,
    title: `Role ${id}`,
    period: null,
    startDate,
    endDate,
    current,
    descriptionHtml: null,
    tags: [],
});

const companies: Company[] = [
    { id: 1, name: 'Acme', city: 'Varese', country: null, description: null, website: null, positions: [position(1, '2011-10', '2014-01')] },
    { id: 2, name: 'Globex', city: null, country: null, description: null, website: null, positions: [position(2, '2016-02', '2020-12')] },
];

describe('work timeline', () => {
    it('lists every position newest first, with its company', () => {
        expect(timelinePositions(companies).map((entry) => `${entry.id}:${entry.org}`)).toEqual(['2:Globex', '1:Acme · Varese']);
    });

    it('spans from the first start year to the last end year, or to now', () => {
        const positions = timelinePositions(companies);

        expect(workSpan(positions, false)).toBe('2011 — 2020');
        expect(workSpan(positions, true)).toBe('2011 — now');
        expect(workSpan([], false)).toBe('');
    });
});
