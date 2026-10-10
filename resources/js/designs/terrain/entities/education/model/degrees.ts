import type { Institute, Program } from '@core/entities/education';

/** Every program of every institute, each carrying its institute's name. */
export function degreesOf(institutes: readonly Institute[]): Program[] {
    return institutes.flatMap((institute) => institute.programs.map((program) => ({ ...program, institute: institute.name })));
}
