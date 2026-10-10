import type { Stat } from '@designs/source/shared/ui';
import type { Highlights } from './types';

/** The stat cards under the hero; facts that are zero or missing are left out. */
export function highlightStats({ certificates, certificateIssuer, latestAward, projects }: Highlights, languages: number): Stat[] {
    const items: Stat[] = [];

    if (certificates > 0) {
        items.push({ value: String(certificates), label: certificateIssuer ? `${certificateIssuer} certifications` : 'certifications' });
    }

    if (latestAward) {
        items.push({ value: latestAward.year ?? 'Award', label: latestAward.title });
    }

    if (projects > 0) {
        items.push({ value: String(projects), label: 'portfolio projects' });
    }

    if (languages > 0) {
        items.push({ value: String(languages), label: 'spoken languages' });
    }

    return items;
}
