<script setup lang="ts">
import { useSiteMenu } from '@core/features/site-menu';
import { useProfile } from '@designs/bento/entities/profile';
import { ThemeToggle } from '@designs/bento/features/theme-toggle';
import { IconButton } from '@designs/bento/shared/ui';
import { Link } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

/**
 * Floating pill header: brand, primary navigation, theme toggle and, on small
 * screens, a menu button that opens the navigation as a panel (Escape closes it).
 */
const { profile } = useProfile();
const { items, menuOpen, toggleMenu, closeMenu } = useSiteMenu();
const menuButton = ref<InstanceType<typeof IconButton> | null>(null);

async function onKeydown(event: KeyboardEvent): Promise<void> {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        await nextTick();
        (menuButton.value?.$el as HTMLElement | undefined)?.focus();
    }
}
</script>

<template>
    <header class="site-header wrap" @keydown="onKeydown">
        <div class="bar">
            <Link class="brand" href="/">
                <span class="brand__dot" aria-hidden="true"></span>{{ profile.name }}
            </Link>
            <nav id="site-menu" class="nav" :class="{ 'is-open': menuOpen }" aria-label="Primary">
                <ul class="nav__list">
                    <li v-for="item in items" :key="item.href">
                        <Link class="nav__link" :href="item.href" :aria-current="item.current ? 'page' : undefined">{{ item.label }}</Link>
                    </li>
                </ul>
            </nav>
            <div class="bar__actions">
                <ThemeToggle />
                <IconButton
                    ref="menuButton"
                    class="menu-btn"
                    :icon="menuOpen ? 'close' : 'menu'"
                    label="Menu"
                    :expanded="menuOpen"
                    controls="site-menu"
                    @click="toggleMenu"
                />
            </div>
        </div>
    </header>
</template>
