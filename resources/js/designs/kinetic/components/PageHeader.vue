<script setup>
/**
 * The oversized page title. `title` and `accent` are joined without a space,
 * so "Experi" + "ence." reads as one word with an orange tail.
 * Layouts: stack (title over intro), split (intro beside the title), grid (two columns).
 */
defineProps({
    title: { type: String, required: true },
    accent: { type: String, default: '' },
    intro: { type: String, default: '' },
    size: { type: String, default: 'xl', validator: (v) => ['xl', '2xl'].includes(v) },
    layout: { type: String, default: 'stack', validator: (v) => ['stack', 'split', 'grid'].includes(v) },
    ruled: { type: Boolean, default: true },
    accentBlock: { type: Boolean, default: false },
});
</script>

<template>
    <header class="page-header" :class="[`page-header--${layout}`, { 'page-header--ruled': ruled }]">
        <h1 class="page-header__title display" :class="`page-header__title--${size}`">
            {{ title }}<span v-if="accent" class="text-accent" :class="{ 'page-header__accent-block': accentBlock }">{{ accent }}</span>
        </h1>
        <p v-if="intro" class="page-header__intro">{{ intro }}</p>
        <slot />
    </header>
</template>
