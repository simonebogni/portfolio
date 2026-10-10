import type { Certificate } from '@core/entities/certificate';
import type { CurrentRole } from '@core/entities/profile';
import type { Company } from '@core/entities/work';

/** The current role from config/profile.php, shown only when it is filled in and not already in the database. */
export function unlistedCurrentRole(role: CurrentRole | null | undefined, companies: readonly Company[]): CurrentRole | null {
    const listed = companies.some((company) => company.positions.some((position) => position.current));

    return role?.company && !listed ? role : null;
}

/** "Coursera, Udemy": every certificate issuer, once. */
export function issuersOf(certificates: readonly Certificate[]): string {
    return [...new Set(certificates.map((certificate) => certificate.issuedBy).filter(Boolean))].join(', ');
}
