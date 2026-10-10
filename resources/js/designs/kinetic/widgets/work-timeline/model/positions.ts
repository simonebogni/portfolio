import type { Company, WorkPosition } from '@core/entities/work';
import { formatYear } from '@core/shared/lib';

/** A position with the company it belongs to, as "Company · City". */
export interface TimelinePosition extends WorkPosition {
    org: string;
}

/** Every position of every company, newest first. */
export function timelinePositions(companies: readonly Company[]): TimelinePosition[] {
    return companies
        .flatMap((company) =>
            company.positions.map((position) => ({
                ...position,
                org: [company.name, company.city].filter(Boolean).join(' · '),
            })),
        )
        .sort((a, b) => String(b.startDate ?? '').localeCompare(String(a.startDate ?? '')));
}

/**
 * The kicker over the timeline: "2011 — 2020", or "2011 — now" while a role is current.
 * `positions` are newest first; '' when there are none.
 */
export function workSpan(positions: readonly TimelinePosition[], hasCurrentRole: boolean): string {
    const first = positions.at(-1);

    if (!first) {
        return '';
    }

    const end = hasCurrentRole || positions.some((position) => position.current) ? 'now' : formatYear(positions[0]?.endDate);

    return `${formatYear(first.startDate)} — ${end}`;
}
