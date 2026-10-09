<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import SmartLink from './SmartLink.vue';

/**
 * Footer: an oversized "Let's talk" link (email, else LinkedIn, else GitHub)
 * and a row with the copyright and the profile links.
 */
const page = usePage();
const profile = computed(() => page.props.profile);
const year = new Date().getFullYear();

const contactHref = computed(() => {
    if (profile.value.email) {
        return `mailto:${profile.value.email}`;
    }

    return profile.value.linkedin_url || profile.value.github_url || null;
});

const links = computed(() =>
    [
        profile.value.github_url && { label: 'GitHub', href: profile.value.github_url },
        profile.value.linkedin_url && { label: 'LinkedIn', href: profile.value.linkedin_url },
        profile.value.email && { label: 'Email', href: `mailto:${profile.value.email}` },
    ].filter(Boolean),
);
</script>

<template>
    <footer class="site-footer">
        <div class="container">
            <SmartLink v-if="contactHref" class="site-footer__cta display" :href="contactHref">
                Let's <span class="text-accent">talk</span> <span aria-hidden="true">→</span>
            </SmartLink>
            <div class="site-footer__row">
                <p class="site-footer__legal">© {{ year }} {{ profile.name }}<template v-if="profile.location"> · {{ profile.location }}</template></p>
                <ul v-if="links.length" class="site-footer__links plain-list" aria-label="Elsewhere">
                    <li v-for="link in links" :key="link.label">
                        <SmartLink :href="link.href">{{ link.label }}</SmartLink>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>
