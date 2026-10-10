<script setup>
import { computed } from 'vue';
import BaseButton from './BaseButton.vue';
import BaseIcon from './BaseIcon.vue';
import IconButton from './IconButton.vue';

/** Footer with a contact call to action and the profile links from config/profile.php. */
const props = defineProps({
    profile: { type: Object, required: true },
});

const contactHref = computed(() => {
    if (props.profile.email) {
        return `mailto:${props.profile.email}`;
    }

    return props.profile.linkedin_url || props.profile.github_url || null;
});

const year = new Date().getFullYear();
const credits = computed(() =>
    [props.profile.name, props.profile.roles.slice(0, 2).join(', '), props.profile.location].filter(Boolean).join(' · '),
);
</script>

<template>
    <footer class="site-footer">
        <div class="wrap">
            <div v-if="contactHref" class="site-footer__top">
                <h2 class="site-footer__title">Got an idea worth building? Let’s talk.</h2>
                <BaseButton :href="contactHref" :icon="profile.email ? 'mail' : null">Get in touch</BaseButton>
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
