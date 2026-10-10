<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useNavigation } from '../composables/useNavigation';
import BaseIcon from './BaseIcon.vue';
import ThemeToggle from './ThemeToggle.vue';

/**
 * Site header: brand, primary navigation (a pill bar on wide screens, a drop-down
 * panel on small ones), theme switch and menu button. Escape closes the menu and
 * returns focus to the menu button.
 */
defineProps({
    name: { type: String, required: true },
});

const { items, menuOpen, toggleMenu, closeMenu } = useNavigation();
const menuButton = ref(null);

function onKeydown(event) {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        menuButton.value?.focus();
    }
}
</script>

<template>
    <header class="site-header" @keydown="onKeydown">
        <div class="wrap site-header__inner">
            <Link class="brand" href="/">
                <span class="brand__mark" aria-hidden="true" />
                {{ name }}
            </Link>
            <nav id="site-menu" class="site-nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                <ul class="site-nav__list plain-list">
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
                    class="icon-btn site-header__menu-button"
                    type="button"
                    aria-label="Menu"
                    aria-controls="site-menu"
                    :aria-expanded="menuOpen ? 'true' : 'false'"
                    @click="toggleMenu"
                >
                    <BaseIcon :name="menuOpen ? 'close' : 'menu'" />
                </button>
            </div>
        </div>
    </header>
</template>
