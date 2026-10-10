import type { SkillCategory } from '@core/entities/skill';

/** The names of every skill of a category, across its subcategories. */
export function skillNames(category: SkillCategory): string[] {
    return category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name));
}
