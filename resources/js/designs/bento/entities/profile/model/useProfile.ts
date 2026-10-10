import { useProfile as useCoreProfile, type UseProfile as UseCoreProfile } from '@core/entities/profile';
import { computed, type ComputedRef } from 'vue';
import { bentoContact, type BentoContact } from './contact';
import type { BentoProfile } from './types';

export interface UseProfile extends Omit<UseCoreProfile<BentoProfile>, 'contact'> {
    contact: ComputedRef<BentoContact | null>;
}

/** The shared profile with Bento's copy, and the best contact link worded for the design. */
export function useProfile(): UseProfile {
    const core = useCoreProfile<BentoProfile>();

    return { ...core, contact: computed(() => bentoContact(core.contact.value)) };
}
