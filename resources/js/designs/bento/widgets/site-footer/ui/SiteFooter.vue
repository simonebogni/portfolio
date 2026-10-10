<script setup lang="ts">
import { useProfile } from '@designs/bento/entities/profile';
import { IconButton, type IconName } from '@designs/bento/shared/ui';
import { computed } from 'vue';

/** Footer: copyright line and round links to the profiles that are configured. */
const { profile } = useProfile();
const year = new Date().getFullYear();

interface FooterLink {
    href: string;
    icon: IconName;
    label: string;
}

const links = computed(() => {
    const list: FooterLink[] = [];

    if (profile.value.github_url) {
        list.push({ href: profile.value.github_url, icon: 'github', label: 'GitHub profile' });
    }

    if (profile.value.linkedin_url) {
        list.push({ href: profile.value.linkedin_url, icon: 'linkedin', label: 'LinkedIn profile' });
    }

    if (profile.value.email) {
        list.push({ href: `mailto:${profile.value.email}`, icon: 'mail', label: 'Send an email' });
    }

    return list;
});
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
