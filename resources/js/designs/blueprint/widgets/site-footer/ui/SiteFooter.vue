<script setup lang="ts">
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { AppButton } from '@designs/blueprint/shared/ui';
import { computed } from 'vue';

/** Inverted footer band: the contact call to action, then copyright and links elsewhere. */
const { profile, contact } = useBlueprintProfile();
const year = new Date().getFullYear();

interface SocialLink {
    label: string;
    href: string;
}

const socialLinks = computed(() =>
    [
        { label: 'GitHub', href: profile.value.github_url },
        { label: 'LinkedIn', href: profile.value.linkedin_url },
        { label: 'Email', href: profile.value.email ? `mailto:${profile.value.email}` : null },
    ].filter((link): link is SocialLink => Boolean(link.href)),
);
</script>

<template>
    <footer class="site-footer">
        <div class="container">
            <div v-if="profile.contact_prompt || contact" class="site-footer__cta">
                <h2 v-if="profile.contact_prompt" class="site-footer__title">{{ profile.contact_prompt }}</h2>
                <AppButton v-if="contact" :href="contact.href">{{ contact.label }}</AppButton>
            </div>
            <div class="site-footer__row">
                <p>© {{ year }} {{ profile.name }} · {{ profile.location }}</p>
                <ul v-if="socialLinks.length" class="site-footer__links" aria-label="Elsewhere">
                    <li v-for="link in socialLinks" :key="link.label">
                        <a
                            :href="link.href"
                            :target="link.href.startsWith('http') ? '_blank' : undefined"
                            :rel="link.href.startsWith('http') ? 'noopener noreferrer' : undefined"
                        >
                            {{ link.label }}<span v-if="link.href.startsWith('http')" class="visually-hidden"> (opens in a new tab)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>
