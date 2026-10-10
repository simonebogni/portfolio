<script setup lang="ts">
import { useSiteMenu } from '@core/features/site-menu';
import { initials } from '@core/shared/lib';
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { ThemeToggle } from '@designs/blueprint/features/theme-toggle';
import { BpIcon } from '@designs/blueprint/shared/ui';
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

/** Brand, primary navigation (a dropdown on mobile), theme toggle and menu button. */
const { profile } = useBlueprintProfile();
const { items, menuOpen, toggleMenu, closeMenu } = useSiteMenu({
    Portfolio: 'Case studies',
    SoftSkills: 'How I work',
});

const menuButton = ref<HTMLButtonElement | null>(null);
const brandRoles = computed(() => profile.value.roles.slice(0, 2).join(' · '));

/** Escape closes the mobile menu and returns focus to its button. */
function onHeaderKeydown(event: KeyboardEvent): void {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        menuButton.value?.focus();
    }
}
</script>

<template>
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
</template>
