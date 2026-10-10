import type { Project, ProjectCategory } from '@core/entities/project';
import { formatYear } from '@core/shared/lib';
import type { LabelledValue } from '@designs/blueprint/shared/ui';

/** "Web applications · Online store": the card's kicker. */
export function projectKind(project: Project, category: ProjectCategory): string {
    return [category.title, project.subtitle].filter(Boolean).join(' · ');
}

/** The card's spec sheet: type, year and up to six technologies. */
export function projectMeta(project: Project, category: ProjectCategory): LabelledValue[] {
    return [
        { label: 'Type', value: category.title },
        { label: 'Year', value: formatYear(project.date) },
        { label: 'Stack', value: project.tags.slice(0, 6).join(' · ') },
    ];
}

/** The project's main link: the live site, else the source code. */
export function primaryUrl(project: Project): string | null {
    return project.liveUrl || project.gitRepoUrl;
}

/** "Web applications — Laravel · Vue · Postgres": the compact line under "More projects". */
export function projectLine(project: Project, category: ProjectCategory): string {
    return [category.title, project.tags.slice(0, 3).join(' · ')].filter(Boolean).join(' — ');
}
