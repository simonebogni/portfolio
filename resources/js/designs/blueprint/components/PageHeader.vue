<script setup>
import TagLabel from './TagLabel.vue';

/** Page title band on the blueprint grid: tag, the page's single <h1>, intro, extra slot. */
defineProps({
    tag: { type: String, default: '' },
    title: { type: String, required: true },
    intro: { type: String, default: '' },
});
</script>

<template>
    <header class="page-header blueprint-grid">
        <div class="container page-header__inner">
            <TagLabel v-if="tag">{{ tag }}</TagLabel>
            <h1 class="page-header__title">{{ title }}</h1>
            <p v-if="intro" class="page-header__intro">{{ intro }}</p>
            <slot />
        </div>
    </header>
</template>
