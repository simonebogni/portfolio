import type { Language } from '@core/entities/language';
import type { SkillCategory } from '@core/entities/skill';

/** Facts for the home page, counted or read from the database (App\Designs\Props\SourceProps). */
export interface Highlights {
    education: string | null;
    certificates: number;
    certificateIssuer: string | null;
    projects: number;
    latestAward: { title: string; year: string | null } | null;
}

export interface AboutProps {
    languages: Language[];
    skillCategories: SkillCategory[];
    highlights: Highlights;
}
