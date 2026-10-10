import type { LabelledValue } from '@designs/blueprint/shared/ui';
import type { BlueprintProfile } from './types';

/** The featured leadership case study, ready to render. */
export interface FeaturedCaseStudy {
    title: string;
    summary: string;
    url: string | null;
    meta: LabelledValue[];
}

/** The configured leadership case study (config/designs.php), or null when it has no title. */
export function featuredCaseStudy(profile: BlueprintProfile, teamSize: number, fill: (text: string | null | undefined) => string): FeaturedCaseStudy | null {
    const study = profile.featured_case_study;

    if (!study?.title) {
        return null;
    }

    return {
        title: study.title,
        summary: fill(study.summary),
        url: study.url,
        meta: [
            { label: 'Role', value: profile.current_role.title },
            { label: 'Team', value: teamSize > 0 ? `${teamSize} developers` : null },
            { label: 'Partners', value: profile.current_role.partners },
            { label: 'Stack', value: study.stack },
            { label: 'Outcome', value: study.outcome },
        ],
    };
}
