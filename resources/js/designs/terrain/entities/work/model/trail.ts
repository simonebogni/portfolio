import type { CurrentRole } from '@core/entities/profile';
import type { Company, WorkPosition } from '@core/entities/work';
import { formatMonthYear } from '@core/shared/lib';

/** A work position with its company, as one line: "Acme · Milan, Italy". */
export interface TrailPosition extends WorkPosition {
    org: string;
}

/** The current role from config/profile.php, as a stop on the trail. */
export interface CurrentRoleStop {
    title: string;
    when: string;
    org: string;
    summary: string | null;
}

/** Every work position, newest first, with its company. */
export function trailPositions(companies: readonly Company[]): TrailPosition[] {
    return companies
        .flatMap((company) =>
            company.positions.map((position) => ({
                ...position,
                org: [company.name, [company.city, company.country].filter(Boolean).join(', ')].filter(Boolean).join(' · '),
            })),
        )
        .sort((a, b) => String(b.startDate ?? '').localeCompare(String(a.startDate ?? '')));
}

/** The current role, shown first unless a position is already marked current. */
export function currentRoleStop(
    role: CurrentRole | null | undefined,
    location: string | null | undefined,
    positions: readonly WorkPosition[],
): CurrentRoleStop | null {
    if (!role?.title || positions.some((position) => position.current)) {
        return null;
    }

    return {
        title: role.title,
        when: role.since ? `${formatMonthYear(role.since)} – present` : 'Present',
        org: [role.company, location].filter(Boolean).join(' · '),
        summary: role.summary,
    };
}
