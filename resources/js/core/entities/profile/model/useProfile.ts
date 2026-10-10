import { usePage } from '@inertiajs/vue3';
import { computed, type ComputedRef } from 'vue';
import { type ContactLink, contactLink } from './contact';
import { cityOf, fillProfileCopy } from './copy';
import type { Profile } from './types';

export interface UseProfile<T extends Profile> {
    profile: ComputedRef<T>;
    teamSize: ComputedRef<number>;
    city: ComputedRef<string>;
    contact: ComputedRef<ContactLink | null>;
    /** Fills `:team_size` in a piece of config copy. */
    fill: (text: string | null | undefined) => string;
}

/**
 * The shared `profile` prop and values derived from it. A design passes its own profile type
 * (Profile plus its copy from config/designs.php) as `T`.
 */
export function useProfile<T extends Profile = Profile>(): UseProfile<T> {
    const page = usePage();
    const profile = computed(() => page.props['profile'] as T);

    return {
        profile,
        teamSize: computed(() => Number(profile.value?.current_role?.team_size ?? 0)),
        city: computed(() => cityOf(profile.value?.location)),
        contact: computed(() => contactLink(profile.value)),
        fill: (text) => fillProfileCopy(text, profile.value),
    };
}
