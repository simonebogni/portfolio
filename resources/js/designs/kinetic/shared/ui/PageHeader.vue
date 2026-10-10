<script setup lang="ts">
/**
 * The oversized page title. `title` and `accent` are joined without a space,
 * so "Experi" + "ence." reads as one word with an orange tail.
 * Layouts: stack (title over intro), split (intro beside the title), grid (two columns).
 */
withDefaults(
    defineProps<{
        title: string;
        accent?: string;
        intro?: string | null;
        size?: 'xl' | '2xl';
        layout?: 'stack' | 'split' | 'grid';
        ruled?: boolean;
        accentBlock?: boolean;
    }>(),
    { accent: '', intro: '', size: 'xl', layout: 'stack', ruled: true, accentBlock: false },
);
</script>

<template>
    <header class="page-header" :class="[`page-header--${layout}`, { 'page-header--ruled': ruled }]">
        <h1 class="page-header__title display" :class="`page-header__title--${size}`">
            {{ title }}<span v-if="accent" class="text-accent" :class="{ 'page-header__accent-block': accentBlock }">{{ accent }}</span>
        </h1>
        <p v-if="intro" class="page-header__intro">{{ intro }}</p>
        <slot></slot>
    </header>
</template>
