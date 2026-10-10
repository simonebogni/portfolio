import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * The shared `profile` prop (config/profile.php) plus derived values:
 * the best available contact link (email, then LinkedIn, then GitHub) and the city.
 */
export function useProfile() {
    const page = usePage();
    const profile = computed(() => page.props.profile);

    const contact = computed(() => {
        const { email, linkedin_url: linkedin, github_url: github } = profile.value;

        if (email) {
            return { href: `mailto:${email}`, label: 'Get in touch', icon: 'mail' };
        }

        if (linkedin) {
            return { href: linkedin, label: 'Get in touch on LinkedIn', icon: 'linkedin' };
        }

        if (github) {
            return { href: github, label: 'Find me on GitHub', icon: 'github' };
        }

        return null;
    });

    const city = computed(() => String(profile.value.location ?? '').split(',')[0].trim());

    return { profile, contact, city };
}
