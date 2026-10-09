<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useNavigation } from '../composables/useNavigation';
import { useProfile } from '../composables/useProfile';
import PillButton from './PillButton.vue';
import ThemeToggle from './ThemeToggle.vue';

/** Brand, primary navigation (a disclosure menu on small screens) and the theme switch. */
const { profile } = useProfile();
const { items, menuOpen, toggleMenu, closeMenu } = useNavigation({ Portfolio: 'Selected work', SoftSkills: 'Principles' });
const menuButton = ref(null);

function onKeydown(event) {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        menuButton.value?.$el?.focus();
    }
}
</script>

<template>
    <header class="site-header" @keydown="onKeydown">
        <div class="wrap site-header__inner">
            <Link class="site-header__brand" href="/">{{ profile.name }}</Link>
            <nav id="site-menu" class="site-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                <ul class="site-nav__list">
                    <li v-for="item in items" :key="item.href">
                        <Link class="site-nav__link" :href="item.href" :aria-current="item.current ? 'page' : undefined">
                            {{ item.label }}
                        </Link>
                    </li>
                </ul>
            </nav>
            <ThemeToggle />
            <PillButton
                ref="menuButton"
                class="site-header__menu-button"
                aria-controls="site-menu"
                :aria-expanded="String(menuOpen)"
                @click="toggleMenu"
            >
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path v-if="menuOpen" d="M6 6l12 12M18 6L6 18" />
                    <path v-else d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                Menu
            </PillButton>
        </div>
    </header>
</template>
