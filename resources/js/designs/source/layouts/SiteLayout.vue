<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import IconButton from '../components/IconButton.vue';
import ThemeToggle from '../components/ThemeToggle.vue';
import { useNavigation } from '../composables/useNavigation';

const page = usePage();
const profile = computed(() => page.props.profile);

// Each page is a "file" in the editor tabs.
const { items, menuOpen, toggleMenu, closeMenu } = useNavigation({
    About: 'about.vue',
    Experience: 'experience.vue',
    Portfolio: 'portfolio.vue',
    SoftSkills: 'soft-skills.vue',
    Hobbies: 'hobbies.vue',
});

const nameParts = computed(() => profile.value.name.trim().split(/\s+/));
const handle = computed(() => nameParts.value.join('.').toLowerCase());
const initials = computed(() =>
    nameParts.value
        .slice(0, 2)
        .map((part) => part[0])
        .join('')
        .toLowerCase(),
);

const menuButton = ref(null);

function onHeaderKeydown(event) {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        menuButton.value?.$el?.focus();
    }
}
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <header class="site-header" @keydown="onHeaderKeydown">
            <div class="container site-header__inner">
                <Link class="brand" href="/" :aria-label="`${profile.name}, home`">
                    <span class="brand__mark" aria-hidden="true">{{ initials }}</span>
                    <span aria-hidden="true">{{ handle }}</span>
                </Link>
                <nav id="site-menu" class="site-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                    <ul class="site-nav__list">
                        <li v-for="item in items" :key="item.href">
                            <Link class="site-nav__link" :href="item.href" :aria-current="item.current ? 'page' : undefined">{{ item.label }}</Link>
                        </li>
                    </ul>
                </nav>
                <div class="site-header__actions">
                    <ThemeToggle />
                    <IconButton
                        ref="menuButton"
                        class="menu-button"
                        :icon="menuOpen ? 'close' : 'menu'"
                        :label="menuOpen ? 'Close menu' : 'Open menu'"
                        aria-controls="site-menu"
                        :aria-expanded="menuOpen ? 'true' : 'false'"
                        @click="toggleMenu"
                    />
                </div>
            </div>
        </header>
        <main id="main" class="site-main container" tabindex="-1">
            <slot />
        </main>
        <footer class="site-footer">
            <div class="container site-footer__inner">
                <p class="site-footer__text">
                    <strong>{{ profile.name }}</strong> — {{ profile.roles.slice(0, 2).join(', ') }}
                    <template v-if="profile.location"> · {{ profile.location }}</template>
                </p>
                <ul class="bare-list site-footer__links">
                    <li v-if="profile.github_url"><IconButton icon="github" label="GitHub profile" :href="profile.github_url" /></li>
                    <li v-if="profile.linkedin_url"><IconButton icon="linkedin" label="LinkedIn profile" :href="profile.linkedin_url" /></li>
                    <li v-if="profile.email"><IconButton icon="mail" label="Send an email" :href="`mailto:${profile.email}`" /></li>
                </ul>
            </div>
        </footer>
    </div>
</template>
