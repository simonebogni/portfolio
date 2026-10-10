import type { SkillCategory } from '@core/entities/skill';
import type { StatItem } from '@designs/kinetic/shared/ui';
import type { KineticStats } from './types';

/** The skill names of a category, in order. */
export function skillsOf(category: SkillCategory): string[] {
    return category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name));
}

/** Every skill once, without notes such as "(past)", for the scrolling band. */
export function tickerItems(categories: readonly SkillCategory[]): string[] {
    return [
        ...new Set(
            categories
                .flatMap(skillsOf)
                .map((name) => name.replace(/\s*\(.*?\)\s*/g, ' ').trim())
                .filter((name) => name && name.length <= 24),
        ),
    ];
}

interface Highlight extends StatItem {
    /** The number behind a figure that is not a plain number ("3×"). */
    count?: number;
}

/** The big figures of the home page; zero counts are left out. */
export function highlights(stats: KineticStats, languageCount: number): Highlight[] {
    const items: Highlight[] = [
        { value: stats.projects, label: 'portfolio projects' },
        { value: `${stats.certificates}×`, label: 'certifications', count: stats.certificates },
        { value: stats.awards, label: stats.awards === 1 ? 'award' : 'awards' },
        { value: languageCount, label: 'spoken languages' },
    ];

    return items.filter((item) => (item.count ?? Number(item.value)) > 0);
}
