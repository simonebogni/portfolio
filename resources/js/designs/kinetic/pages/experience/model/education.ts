import type { Certificate } from '@core/entities/certificate';
import type { Institute, Program } from '@core/entities/education';

/** A degree with the name and website of its institute. */
export interface Degree extends Program {
    institute: string;
    website: string | null;
}

/** Every programme of every institute; degrees and awards share the "duo" panels. */
export function degreesOf(institutes: readonly Institute[]): Degree[] {
    return institutes.flatMap((institute) => institute.programs.map((program) => ({ ...program, institute: institute.name, website: institute.website })));
}

/** The certificate issuers, once each: "FreeCodeCamp.org · Coursera". */
export function issuersOf(certificates: readonly Certificate[]): string {
    return [...new Set(certificates.map((certificate) => certificate.issuedBy).filter(Boolean))].join(' · ');
}

/** Where a course was taken: "University · Coursera". */
export function learningPlace(program: Program): string {
    return [program.institute, program.onlinePlatform].filter(Boolean).join(' · ');
}
