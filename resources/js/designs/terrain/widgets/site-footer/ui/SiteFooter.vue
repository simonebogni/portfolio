<script setup lang="ts">
import { contactLink } from '@core/entities/profile';
import type { TerrainProfile } from '@designs/terrain/entities/profile';
import { BaseButton, BaseIcon, IconButton } from '@designs/terrain/shared/ui';
import { computed } from 'vue';

/** Footer with a contact call to action and the profile links from config/profile.php. */
const props = defineProps<{
    profile: TerrainProfile;
}>();

/** Email first, then LinkedIn, then GitHub. */
const contact = computed(() => contactLink(props.profile));

const year = new Date().getFullYear();
const credits = computed(() => [props.profile.name, props.profile.roles.slice(0, 2).join(', '), props.profile.location].filter(Boolean).join(' · '));
</script>

<template>
    <footer class="site-footer">
        <div class="wrap">
            <div v-if="contact" class="site-footer__top">
                <h2 class="site-footer__title">Got an idea worth building? Let’s talk.</h2>
                <BaseButton :href="contact.href" :icon="contact.channel === 'email' ? 'mail' : null">Get in touch</BaseButton>
            </div>
            <div class="site-footer__row">
                <p>© {{ year }} {{ credits }}</p>
                <ul class="site-footer__links plain-list">
                    <li v-if="profile.github_url">
                        <IconButton :href="profile.github_url" label="GitHub profile"><BaseIcon name="github" /></IconButton>
                    </li>
                    <li v-if="profile.linkedin_url">
                        <IconButton :href="profile.linkedin_url" label="LinkedIn profile"><BaseIcon name="linkedin" /></IconButton>
                    </li>
                    <li v-if="profile.email">
                        <IconButton :href="`mailto:${profile.email}`" :label="`Email ${profile.name}`"><BaseIcon name="mail" /></IconButton>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>
