<script setup>
import { computed } from 'vue';

/**
 * Footer: a large serif call to get in touch (when an email or LinkedIn URL is configured), the
 * availability note, and the copyright line with the profile links.
 */
const props = defineProps({
    profile: { type: Object, required: true },
});

const year = new Date().getFullYear();

// Prefer email for the call to action, then LinkedIn.
const contactHref = computed(() =>
    props.profile.email ? `mailto:${props.profile.email}` : (props.profile.linkedin_url || ''),
);

const links = computed(() =>
    [
        props.profile.github_url && { label: 'GitHub', href: props.profile.github_url },
        props.profile.linkedin_url && { label: 'LinkedIn', href: props.profile.linkedin_url },
        props.profile.email && { label: 'Email', href: `mailto:${props.profile.email}` },
    ].filter(Boolean),
);
</script>

<template>
    <footer class="site-footer">
        <div class="wrap">
            <h2 v-if="contactHref" class="site-footer__call">
                <a :href="contactHref">Let's work together.</a>
            </h2>
            <p v-if="profile.availability" class="site-footer__note">{{ profile.availability }}</p>
            <div class="site-footer__row">
                <p class="site-footer__copy">© {{ year }} {{ profile.name }} · {{ profile.location }}</p>
                <ul v-if="links.length" class="site-footer__links">
                    <li v-for="link in links" :key="link.label">
                        <a :href="link.href" rel="me noopener">{{ link.label }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>
