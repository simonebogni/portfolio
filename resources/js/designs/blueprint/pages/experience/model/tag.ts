import type { Company } from '@core/entities/work';
import { formatYear } from '@core/shared/lib';

/** The year of the earliest position with a start date, or null. */
export function firstYear(companies: readonly Company[]): number | null {
    const years = companies
        .flatMap((company) => company.positions.map((position) => Number(formatYear(position.startDate))))
        .filter((year) => year > 0);

    return years.length ? Math.min(...years) : null;
}

/** The page tag: "Experience · 2011 – present" ("present" only with a current role). */
export function experienceTag(companies: readonly Company[], hasCurrentRole: boolean): string {
    const year = firstYear(companies);

    if (!year) {
        return 'Experience';
    }

    return `Experience · ${year} – ${hasCurrentRole ? 'present' : ''}`.trim();
}
