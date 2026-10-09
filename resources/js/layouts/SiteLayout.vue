<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useNavigation } from '../composables/useNavigation';
import { useTheme } from '../composables/useTheme';

const page = usePage();
const profile = computed(() => page.props.profile);
const { items, menuOpen, toggleMenu, onMenuKeydown } = useNavigation();
const { isDark, toggle, toggleLabel } = useTheme();
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <header class="site-header">
            <div class="container site-header__inner">
                <Link class="brand" href="/">{{ profile.name }}</Link>
                <button
                    class="menu-button"
                    type="button"
                    aria-controls="site-menu"
                    :aria-expanded="menuOpen"
                    @click="toggleMenu"
                >
                    Menu
                </button>
                <nav id="site-menu" class="site-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary" @keydown="onMenuKeydown">
                    <ul>
                        <li v-for="item in items" :key="item.href">
                            <Link :href="item.href" :aria-current="item.current ? 'page' : undefined">{{ item.label }}</Link>
                        </li>
                    </ul>
                </nav>
                <button class="theme-button" type="button" :aria-pressed="isDark" :aria-label="toggleLabel" @click="toggle">
                    {{ isDark ? 'Light' : 'Dark' }}
                </button>
            </div>
        </header>
        <main id="main" class="container" tabindex="-1">
            <slot />
        </main>
        <footer class="site-footer">
            <div class="container">
                <p>{{ profile.name }} · {{ profile.roles.join(' · ') }} · {{ profile.location }}</p>
                <ul class="inline-list">
                    <li v-if="profile.github_url"><a :href="profile.github_url">GitHub</a></li>
                    <li v-if="profile.linkedin_url"><a :href="profile.linkedin_url">LinkedIn</a></li>
                    <li v-if="profile.email"><a :href="`mailto:${profile.email}`">Email</a></li>
                </ul>
            </div>
        </footer>
    </div>
</template>
