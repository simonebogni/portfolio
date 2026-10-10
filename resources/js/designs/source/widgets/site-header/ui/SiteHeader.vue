<script setup lang="ts">
import { useSiteMenu } from '@core/features/site-menu';
import { brandMark, handle, useSourceProfile } from '@designs/source/entities/profile';
import { ThemeToggle } from '@designs/source/features/theme-toggle';
import { IconButton } from '@designs/source/shared/ui';
import { Link } from '@inertiajs/vue3';
import { computed, useTemplateRef } from 'vue';

const { profile } = useSourceProfile();

// Each page is a "file" in the editor tabs.
const { items, menuOpen, toggleMenu, closeMenu } = useSiteMenu({
    About: 'about.vue',
    Experience: 'experience.vue',
    Portfolio: 'portfolio.vue',
    SoftSkills: 'soft-skills.vue',
    Hobbies: 'hobbies.vue',
});

const brand = computed(() => handle(profile.value.name));
const mark = computed(() => brandMark(profile.value.name));

const menuButton = useTemplateRef<InstanceType<typeof IconButton>>('menuButton');

function onHeaderKeydown(event: KeyboardEvent): void {
    if (event.key === 'Escape' && menuOpen.value) {
        closeMenu();
        (menuButton.value?.$el as HTMLElement | undefined)?.focus();
    }
}
</script>

<template>
    <header class="site-header" @keydown="onHeaderKeydown">
        <div class="container site-header__inner">
            <Link class="brand" href="/" :aria-label="`${profile.name}, home`">
                <span class="brand__mark" aria-hidden="true">{{ mark }}</span>
                <span aria-hidden="true">{{ brand }}</span>
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
</template>
