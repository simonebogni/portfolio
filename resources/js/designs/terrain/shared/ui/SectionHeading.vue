<script setup lang="ts">
import EyebrowText from './EyebrowText.vue';

/**
 * Section title. Pass the same id to the section's aria-labelledby.
 * variant="inline" puts the meta text (e.g. a count) on the right, for sub-sections.
 */
withDefaults(
    defineProps<{
        id: string;
        title: string;
        eyebrow?: string | null;
        meta?: string | null;
        level?: number;
        variant?: 'stack' | 'inline';
    }>(),
    { eyebrow: null, meta: null, level: 2, variant: 'stack' },
);
</script>

<template>
    <div class="section-heading" :class="`section-heading--${variant}`">
        <EyebrowText v-if="eyebrow">{{ eyebrow }}</EyebrowText>
        <component :is="`h${level}`" :id="id" class="section-heading__title">{{ title }}</component>
        <p v-if="meta" class="section-heading__meta">{{ meta }}</p>
    </div>
</template>
