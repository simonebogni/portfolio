import type { Stat } from '@designs/terrain/shared/ui';
import type { Highlights } from './props';

/** The highlights strip: projects, certifications, languages and awards; zero counts are left out. */
export function highlightStats(highlights: Highlights, languageCount: number): Stat[] {
    return [
        { count: highlights.projects, singular: 'portfolio project' },
        { count: highlights.certificates, singular: 'certification' },
        { count: languageCount, singular: 'spoken language' },
        { count: highlights.awards, singular: 'award' },
    ]
        .filter((stat) => stat.count > 0)
        .map((stat) => ({ value: stat.count, label: stat.count === 1 ? stat.singular : `${stat.singular}s` }));
}
