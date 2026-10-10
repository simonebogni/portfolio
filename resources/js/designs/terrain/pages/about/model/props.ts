import type { Language } from '@core/entities/language';
import type { SkillCategory } from '@core/entities/skill';

/** Counts shown in the highlights strip (App\Designs\Props\TerrainProps::about). */
export interface Highlights {
    projects: number;
    certificates: number;
    awards: number;
}

/** Props of the About page (AboutController plus Terrain's extras). */
export interface AboutProps {
    languages: Language[];
    skillCategories: SkillCategory[];
    highlights: Highlights;
}
