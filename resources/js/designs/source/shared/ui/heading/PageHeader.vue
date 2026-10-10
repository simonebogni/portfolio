<script setup lang="ts">
/**
 * Page title block: decorative code-comment eyebrow, the page's only <h1>,
 * and an optional one-sentence introduction.
 */
withDefaults(defineProps<{ title: string; eyebrow?: string | null; intro?: string | null; tight?: boolean }>(), { eyebrow: null, intro: null });
</script>

<template>
    <header class="page-header" :class="{ 'page-header--tight': tight }">
        <p v-if="eyebrow" class="eyebrow" aria-hidden="true">{{ eyebrow }}</p>
        <h1 class="page-header__title">{{ title }}</h1>
        <p v-if="intro" class="page-header__intro">{{ intro }}</p>
        <slot></slot>
    </header>
</template>
