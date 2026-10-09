import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { fillTemplate } from '../lib/copy';

/**
 * The shared `profile` prop (config/profile.php), with helpers to fill in its copy
 * templates and to pick the best contact link.
 */
export function useProfile() {
    const page = usePage();
    const profile = computed(() => page.props.profile);

    /** Fills {team_size}, {title}, ... in a copy string. */
    function fill(text) {
        return fillTemplate(text, profile.value);
    }

    /** The preferred way to get in touch: email, then LinkedIn, then GitHub. */
    const contact = computed(() => {
        const p = profile.value;

        if (p.email) {
            return { href: `mailto:${p.email}`, label: 'Get in touch' };
        }

        if (p.linkedin_url) {
            return { href: p.linkedin_url, label: 'Connect on LinkedIn' };
        }

        if (p.github_url) {
            return { href: p.github_url, label: 'Find me on GitHub' };
        }

        return null;
    });

    return { profile, fill, contact };
}
