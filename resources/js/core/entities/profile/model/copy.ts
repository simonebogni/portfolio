import type { Profile } from './types';

/** Replaces `:team_size` in config copy with the configured team size. */
export function fillProfileCopy(text: string | null | undefined, profile: Pick<Profile, 'current_role'> | null | undefined): string {
    if (text === null || text === undefined) {
        return '';
    }

    const teamSize = profile?.current_role?.team_size ?? '';

    return String(text).replaceAll(':team_size', String(teamSize));
}

/** "Tel Aviv, Israel" → "Tel Aviv" */
export function cityOf(location: string | null | undefined): string {
    return String(location ?? '').split(',')[0]?.trim() ?? '';
}
