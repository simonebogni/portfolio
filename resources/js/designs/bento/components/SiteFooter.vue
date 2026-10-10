<script setup>
import { computed } from 'vue';
import { useProfile } from '../composables/useProfile';
import IconButton from './IconButton.vue';

/** Footer: copyright line and round links to the profiles that are configured. */
const { profile } = useProfile();
const year = new Date().getFullYear();

const links = computed(() =>
    [
        profile.value.github_url && { href: profile.value.github_url, icon: 'github', label: 'GitHub profile' },
        profile.value.linkedin_url && { href: profile.value.linkedin_url, icon: 'linkedin', label: 'LinkedIn profile' },
        profile.value.email && { href: `mailto:${profile.value.email}`, icon: 'mail', label: 'Send an email' },
    ].filter(Boolean),
);
</script>

<template>
    <footer class="site-footer">
        <div class="wrap site-footer__inner">
            <p>© {{ year }} {{ profile.name }} · {{ profile.location }}</p>
            <ul v-if="links.length" class="site-footer__links">
                <li v-for="link in links" :key="link.href">
                    <IconButton :href="link.href" :icon="link.icon" :label="link.label" />
                </li>
            </ul>
        </div>
    </footer>
</template>
