<script setup>
import { Link } from '@inertiajs/vue3';
import { nextTick, useTemplateRef } from 'vue';
import { useNavigation } from '../composables/useNavigation';
import { padNumber } from '../lib/format';
import ThemeToggle from './ThemeToggle.vue';

/**
 * Masthead: name, numbered primary navigation, dark-mode toggle and, on narrow
 * screens, a Menu button that opens the navigation as a panel.
 */
defineProps({
    name: { type: String, required: true },
});

const { items, menuOpen, toggleMenu, closeMenu } = useNavigation();
const menuButton = useTemplateRef('menuButton');

async function onKeydown(event) {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        await nextTick();
        menuButton.value?.focus();
    }
}
</script>

<template>
    <header class="masthead" @keydown="onKeydown">
        <div class="wrap masthead__inner">
            <Link class="brand" href="/">{{ name }}</Link>
            <button
                ref="menuButton"
                class="text-button masthead__menu-button"
                type="button"
                aria-controls="site-menu"
                :aria-expanded="menuOpen ? 'true' : 'false'"
                @click="toggleMenu"
            >
                {{ menuOpen ? 'Close' : 'Menu' }}
            </button>
            <nav id="site-menu" class="primary-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                <ul class="primary-nav__list">
                    <li v-for="(item, index) in items" :key="item.href">
                        <Link class="primary-nav__link" :href="item.href" :aria-current="item.current ? 'page' : undefined">
                            <small class="primary-nav__number" aria-hidden="true">{{ padNumber(index + 1) }}</small>{{ item.label }}
                        </Link>
                    </li>
                </ul>
            </nav>
            <ThemeToggle class="masthead__theme" />
        </div>
    </header>
</template>
