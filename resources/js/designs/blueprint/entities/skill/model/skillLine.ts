import type { SkillCategory } from '@core/entities/skill';

/** Every skill of a category, as one line: "PHP, Laravel, Vue". */
export function skillLine(category: SkillCategory): string {
    return category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)).join(', ');
}
