import type { SkillCategory } from '@core/entities/skill';
import type { BentoProfile } from '@designs/bento/entities/profile';

export interface Headline {
    start: string;
    accent: string;
    end: string;
}

/** The headline with its last word split off, so it can take the accent colour. */
export function splitHeadline(text: string): Headline {
    const match = text.trim().match(/^(.*\s)(\S+?)([.!?]?)$/);

    return match ? { start: match[1] ?? '', accent: match[2] ?? '', end: match[3] ?? '' } : { start: '', accent: text.trim(), end: '' };
}

/** The status pill: the availability, else "role · city". */
export function statusLine(profile: Pick<BentoProfile, 'availability' | 'current_role'>, city: string): string {
    return profile.availability || [profile.current_role?.title, city].filter(Boolean).join(' · ');
}

/** "Based in Tel Aviv, Israel. Tech Lead at Acme since 2023." */
export function currentLine(profile: Pick<BentoProfile, 'location' | 'current_role'>): string {
    const role = profile.current_role;
    const parts = [`Based in ${profile.location}.`];

    if (role?.company) {
        parts.push(`${role.title} at ${role.company}${role.since ? ` since ${role.since}` : ''}.`);
    }

    return parts.join(' ');
}

/** "Developer, Designer & Tech Lead" */
export function rolesTitle(roles: readonly string[] | null | undefined): string {
    const list = roles ?? [];

    return list.length > 1 ? `${list.slice(0, -1).join(', ')} & ${list.at(-1)}` : (list[0] ?? '');
}

export interface SkillArea {
    id: number;
    name: string;
    /** Every skill name of the category's subcategories. */
    skills: string[];
}

/** The skill categories with their skills flattened to names. */
export function skillAreas(categories: readonly SkillCategory[]): SkillArea[] {
    return categories.map((category) => ({
        id: category.id,
        name: category.name,
        skills: category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)),
    }));
}
