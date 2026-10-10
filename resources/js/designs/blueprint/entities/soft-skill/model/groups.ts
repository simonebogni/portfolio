import type { SoftSkill } from '@core/entities/soft-skill';

export interface SoftSkillGroup {
    name: string;
    skills: SoftSkill[];
}

/**
 * Soft skills grouped as configured (group name → skill names, matched case-insensitively). The
 * skills no group lists go to "More" ("Soft skills" when there are no groups). Empty groups are dropped.
 */
export function groupSoftSkills(softSkills: readonly SoftSkill[], config: Record<string, readonly string[]>): SoftSkillGroup[] {
    const used = new Set<number>();
    const result = Object.entries(config).map(([name, members]) => {
        const skills = members
            .map((member) => softSkills.find((skill) => skill.name.toLowerCase() === String(member).toLowerCase()))
            .filter((skill): skill is SoftSkill => Boolean(skill));
        skills.forEach((skill) => used.add(skill.id));

        return { name, skills };
    });
    const rest = softSkills.filter((skill) => !used.has(skill.id));

    if (rest.length) {
        result.push({ name: result.length ? 'More' : 'Soft skills', skills: rest });
    }

    return result.filter((group) => group.skills.length);
}
