<script setup>
/**
 * Page title block: decorative code-comment eyebrow, the page's only <h1>,
 * and an optional one-sentence introduction.
 */
defineProps({
    title: { type: String, required: true },
    eyebrow: { type: String, default: null },
    intro: { type: String, default: null },
    tight: { type: Boolean, default: false },
});
</script>

<template>
    <header class="page-header" :class="{ 'page-header--tight': tight }">
        <p v-if="eyebrow" class="eyebrow" aria-hidden="true">{{ eyebrow }}</p>
        <h1 class="page-header__title">{{ title }}</h1>
        <p v-if="intro" class="page-header__intro">{{ intro }}</p>
        <slot />
    </header>
</template>
