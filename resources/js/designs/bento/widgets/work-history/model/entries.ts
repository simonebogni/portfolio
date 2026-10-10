import type { Profile } from '@core/entities/profile';
import type { Company, WorkPosition } from '@core/entities/work';

export interface CurrentRoleEntry {
    title: string;
    period: string;
    organisation: string;
}

export interface PositionEntry extends WorkPosition {
    /** "Acme · Varese, Italy" */
    organisation: string;
}

/** The current role from the profile config, shown first when the database has no current position. */
export function currentRoleEntry(profile: Pick<Profile, 'current_role' | 'location'>, companies: readonly Company[]): CurrentRoleEntry | null {
    const role = profile.current_role;
    const hasCurrent = companies.some((company) => company.positions.some((position) => position.current));

    if (!role?.title || hasCurrent) {
        return null;
    }

    return {
        title: role.title,
        period: role.since ? `${role.since} – present` : '',
        organisation: [role.company, profile.location].filter(Boolean).join(' · '),
    };
}

/** Every position, newest first, with its company. */
export function positionEntries(companies: readonly Company[]): PositionEntry[] {
    return companies
        .flatMap((company) =>
            company.positions.map((position) => ({
                ...position,
                organisation: [company.name, [company.city, company.country].filter(Boolean).join(', ')].filter(Boolean).join(' · '),
            })),
        )
        .sort((a, b) => String(b.startDate ?? '').localeCompare(String(a.startDate ?? '')));
}
