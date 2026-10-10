import type { LabelledValue } from '@designs/blueprint/shared/ui';
import type { AboutHighlights } from './types';

/** The stats strip under the hero; empty values are skipped. */
export function aboutStats(teamSize: number, highlights: AboutHighlights, languageCount: number): LabelledValue[] {
    return [
        { value: teamSize > 0 ? teamSize : null, label: 'Developers led' },
        { value: highlights.firstWorkYear, label: 'Writing software since' },
        { value: highlights.portfolioProjects || null, label: 'Portfolio projects' },
        { value: languageCount || null, label: 'Spoken languages' },
    ];
}
