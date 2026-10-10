import { useProfile } from '@core/entities/profile';
import { computed, type ComputedRef } from 'vue';
import { type ContactAction, contactAction } from './contact';
import type { BlueprintProfile } from './types';

/** The shared profile prop with Blueprint's copy, `teamSize`, `fill()` and the worded contact link. */
export function useBlueprintProfile(): {
    profile: ComputedRef<BlueprintProfile>;
    teamSize: ComputedRef<number>;
    contact: ComputedRef<ContactAction | null>;
    fill: (text: string | null | undefined) => string;
} {
    const { profile, teamSize, contact, fill } = useProfile<BlueprintProfile>();

    return { profile, teamSize, fill, contact: computed(() => contactAction(contact.value)) };
}
