import type { Language } from '@core/entities/language';
import type { SkillCategory } from '@core/entities/skill';

/** Blueprint's extras on the About page (app/Designs/Props/BlueprintProps.php). */
export interface AboutHighlights {
    /** Year of the earliest work position, e.g. 2011. */
    firstWorkYear: number | null;
    portfolioProjects: number;
}

/** The About page props (AboutController + BlueprintProps). */
export interface AboutProps {
    languages: Language[];
    skillCategories: SkillCategory[];
    highlights: AboutHighlights;
}
