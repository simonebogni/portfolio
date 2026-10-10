<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppButton from '../components/AppButton.vue';
import BpIcon from '../components/BpIcon.vue';
import ThemeToggle from '../components/ThemeToggle.vue';
import { useNavigation } from '../composables/useNavigation';
import { useProfile } from '../composables/useProfile';
import { initials } from '../lib/profile';

const { profile, contact } = useProfile();
const { items, menuOpen, toggleMenu, closeMenu } = useNavigation({
    Portfolio: 'Case studies',
    SoftSkills: 'How I work',
});

const menuButton = ref(null);
const brandRoles = computed(() => profile.value.roles.slice(0, 2).join(' · '));
const year = new Date().getFullYear();

const socialLinks = computed(() =>
    [
        { label: 'GitHub', href: profile.value.github_url },
        { label: 'LinkedIn', href: profile.value.linkedin_url },
        { label: 'Email', href: profile.value.email ? `mailto:${profile.value.email}` : null },
    ].filter((link) => link.href),
);

/** Escape closes the mobile menu and returns focus to its button. */
function onHeaderKeydown(event) {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        menuButton.value?.focus();
    }
}
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <header class="site-header" @keydown="onHeaderKeydown">
            <div class="container site-header__inner">
                <Link class="brand" href="/">
                    <span class="brand__mark" aria-hidden="true">{{ initials(profile.name) }}</span>
                    <span class="brand__text">
                        <b>{{ profile.name }}</b>
                        <small>{{ brandRoles }}</small>
                    </span>
                </Link>
                <nav id="site-menu" class="site-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                    <ul class="site-nav__list">
                        <li v-for="item in items" :key="item.href">
                            <Link class="site-nav__link" :href="item.href" :aria-current="item.current ? 'page' : undefined">
                                {{ item.label }}
                            </Link>
                        </li>
                    </ul>
                </nav>
                <div class="site-header__actions">
                    <ThemeToggle />
                    <button
                        ref="menuButton"
                        class="icon-button menu-button"
                        type="button"
                        aria-controls="site-menu"
                        :aria-expanded="menuOpen"
                        :aria-label="menuOpen ? 'Close menu' : 'Open menu'"
                        @click="toggleMenu"
                    >
                        <BpIcon :name="menuOpen ? 'close' : 'menu'" />
                    </button>
                </div>
            </div>
        </header>
        <main id="main" tabindex="-1">
            <slot />
        </main>
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
    </div>
</template>
