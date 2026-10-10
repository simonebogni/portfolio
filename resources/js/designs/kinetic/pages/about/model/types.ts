import type { Language } from '@core/entities/language';
import type { SkillCategory } from '@core/entities/skill';

/** Counts for the home page highlights (app/Designs/Props/KineticProps.php). */
export interface KineticStats {
    projects: number;
    certificates: number;
    awards: number;
}

/** Props of the About page: AboutController plus Kinetic's `stats`. */
export interface AboutProps {
    languages: Language[];
    skillCategories: SkillCategory[];
    stats: KineticStats;
}
