import type { Course } from '@core/entities/education';

/** "28/30 cum laude" */
export function courseScore(course: Course): string {
    return `${course.score}/${course.scoreMax}${course.cumLaude ? ' cum laude' : ''}`;
}
