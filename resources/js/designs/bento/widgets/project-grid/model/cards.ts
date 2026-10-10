import type { Project, ProjectInCategory } from '@core/entities/project';
import { type CardSize, sizesFor } from './sizes';

export interface ProjectCardModel {
    project: Project;
    size: CardSize;
    featured: boolean;
    inverseArt: boolean;
    /** "Featured · Web applications", or the category title. */
    kind: string;
}

/** The cards of the grid: the first one is featured when there are three or more; every fourth art panel (from the second) is dark. */
export function projectCards(projects: readonly ProjectInCategory[]): ProjectCardModel[] {
    const sizes = sizesFor(projects.length);
    const featuredFirst = projects.length > 2;

    return projects.map(({ project, category }, index) => ({
        project,
        size: sizes[index] ?? 'third',
        featured: index === 0 && featuredFirst,
        inverseArt: index % 4 === 1,
        kind: [index === 0 && featuredFirst ? 'Featured' : null, category.title].filter(Boolean).join(' · '),
    }));
}
