import type { SkillCategory } from '@core/entities/skill';

/** The number of skills in every subcategory of a category. */
export function skillCount(category: SkillCategory): number {
    return category.subcategories.reduce((total, subcategory) => total + subcategory.skills.length, 0);
}
