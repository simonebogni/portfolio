import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { contactLink, fillProfile } from '../lib/profile';

/** The shared profile prop, plus helpers bound to it. */
export function useProfile() {
    const page = usePage();
    const profile = computed(() => page.props.profile);
    const teamSize = computed(() => Number(profile.value?.current_role?.team_size ?? 0));
    const contact = computed(() => contactLink(profile.value));

    function fill(text) {
        return fillProfile(text, profile.value);
    }

    return { profile, teamSize, contact, fill };
}
