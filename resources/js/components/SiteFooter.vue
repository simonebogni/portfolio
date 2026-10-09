<script setup>
import { computed } from 'vue';
import { useProfile } from '../composables/useProfile';
import ActionLink from './ActionLink.vue';
import EmphasisText from './EmphasisText.vue';

/** Closing call to action, then copyright and social links. */
const { profile, fill, contact } = useProfile();

const headline = computed(() => fill(profile.value.copy?.contact_headline));
const details = computed(() => [profile.value.location, profile.value.availability].filter(Boolean).join(' · '));
const year = new Date().getFullYear();
</script>

<template>
    <footer class="site-footer">
        <div class="wrap">
            <section class="site-footer__cta" aria-labelledby="contact-title">
                <h2 id="contact-title" class="site-footer__title"><EmphasisText :text="headline" /></h2>
                <div>
                    <p class="site-footer__details">{{ details }}</p>
                    <ActionLink v-if="contact" :href="contact.href">{{ contact.label }}</ActionLink>
                </div>
            </section>
            <div class="site-footer__row">
                <p>© {{ year }} {{ profile.name }}</p>
                <ul class="site-footer__links">
                    <li v-if="profile.github_url"><a :href="profile.github_url">GitHub</a></li>
                    <li v-if="profile.linkedin_url"><a :href="profile.linkedin_url">LinkedIn</a></li>
                    <li v-if="profile.email"><a :href="`mailto:${profile.email}`">Email</a></li>
                </ul>
            </div>
        </div>
    </footer>
</template>
