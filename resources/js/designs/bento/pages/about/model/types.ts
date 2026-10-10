import type { Language } from '@core/entities/language';
import type { SkillCategory } from '@core/entities/skill';

/** The main degree (BentoProps::education). */
export interface AboutEducation {
    name: string;
    institute: string;
    period: string | null;
    endYear: number | null;
}

/** The most recent award (BentoProps::award). */
export interface AboutAward {
    title: string;
    subtitle: string | null;
    /** "YYYY-MM-DD" */
    issueDate: string | null;
}

/** Props of the About page: AboutController plus the Bento extras (app/Designs/Props/BentoProps.php). */
export interface AboutProps {
    languages: Language[];
    skillCategories: SkillCategory[];
    education?: AboutEducation | null;
    award?: AboutAward | null;
    /** The most-used tags across work positions and projects. */
    stack?: string[];
}
