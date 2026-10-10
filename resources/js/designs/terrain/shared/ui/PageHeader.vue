<script setup lang="ts">
import EyebrowText from './EyebrowText.vue';

/**
 * Page title block: eyebrow, the page's single <h1>, and an optional intro.
 * layout="split" puts the intro beside the title on wide screens.
 */
withDefaults(
    defineProps<{
        title: string;
        eyebrow?: string | null;
        intro?: string | null;
        layout?: 'stack' | 'split';
    }>(),
    { eyebrow: null, intro: null, layout: 'stack' },
);
</script>

<template>
    <header class="page-header" :class="`page-header--${layout}`">
        <div>
            <EyebrowText v-if="eyebrow">{{ eyebrow }}</EyebrowText>
            <h1 class="page-header__title">{{ title }}</h1>
        </div>
        <p v-if="intro || $slots.default" class="page-header__intro">
            <slot>{{ intro }}</slot>
        </p>
    </header>
</template>
