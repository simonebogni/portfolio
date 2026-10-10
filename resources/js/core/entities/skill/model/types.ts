/** Programming knowledge, grouped by category and subcategory (AboutController). */
export interface Skill {
    id: number;
    name: string;
}

export interface SkillSubcategory {
    id: number;
    name: string;
    skills: Skill[];
}

export interface SkillCategory {
    id: number;
    name: string;
    subcategories: SkillSubcategory[];
}
