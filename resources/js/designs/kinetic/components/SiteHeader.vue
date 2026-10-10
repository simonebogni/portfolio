<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, nextTick, ref } from 'vue';
import { useNavigation } from '../composables/useNavigation';
import ThemeToggle from './ThemeToggle.vue';

/**
 * Header: monogram brand, primary navigation, theme toggle and, below 800px,
 * a Menu button that opens the navigation as a panel (Escape closes it and
 * returns focus to the button).
 */
const page = usePage();
const name = computed(() => page.props.profile.name);
const initials = computed(() =>
    name.value
        .split(/\s+/)
        .filter(Boolean)
        .map((part) => part[0])
        .join('')
        .slice(0, 3)
        .toUpperCase(),
);

const { items, menuOpen, toggleMenu, closeMenu } = useNavigation();
const menuButton = ref(null);

function onKeydown(event) {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        nextTick(() => menuButton.value?.focus());
    }
}
</script>

<template>
    <header class="site-header" @keydown="onKeydown">
        <div class="container site-header__inner">
            <Link class="brand" href="/">
                <span class="brand__mark" aria-hidden="true" />
                <span aria-hidden="true">{{ initials }}</span>
                <span class="visually-hidden">{{ name }}, home</span>
            </Link>
            <nav id="site-menu" class="site-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                <ul class="site-nav__list plain-list">
                    <li v-for="item in items" :key="item.href">
                        <Link class="site-nav__link" :href="item.href" :aria-current="item.current ? 'page' : undefined">{{ item.label }}</Link>
                    </li>
                </ul>
            </nav>
            <ThemeToggle />
            <button
                ref="menuButton"
                class="menu-button"
                type="button"
                aria-controls="site-menu"
                :aria-expanded="menuOpen"
                @click="toggleMenu"
            >
                <span class="menu-button__icon" :class="{ 'is-open': menuOpen }" aria-hidden="true"><i /><i /></span>
                Menu
            </button>
        </div>
    </header>
</template>
