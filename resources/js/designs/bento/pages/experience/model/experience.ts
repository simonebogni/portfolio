import type { Certificate } from '@core/entities/certificate';
import type { Course } from '@core/entities/education';

/** "28/30 cum laude"; empty when the course has no score. */
export function scoreLabel(course: Pick<Course, 'score' | 'scoreMax' | 'cumLaude'>): string {
    if (course.score === null || course.score === undefined) {
        return '';
    }

    return `${course.score}/${course.scoreMax}${course.cumLaude ? ' cum laude' : ''}`;
}

/** The distinct issuers of the certificates, in order. */
export function certificateIssuers(certificates: readonly Pick<Certificate, 'issuedBy'>[]): string[] {
    return [...new Set(certificates.map((certificate) => certificate.issuedBy).filter((issuer): issuer is string => Boolean(issuer)))];
}
