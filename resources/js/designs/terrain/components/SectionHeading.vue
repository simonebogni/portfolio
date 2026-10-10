<script setup>
import EyebrowText from './EyebrowText.vue';

/**
 * Section title. Pass the same id to the section's aria-labelledby.
 * variant="inline" puts the meta text (e.g. a count) on the right, for sub-sections.
 */
defineProps({
    id: { type: String, required: true },
    title: { type: String, required: true },
    eyebrow: { type: String, default: null },
    meta: { type: String, default: null },
    level: { type: Number, default: 2 },
    variant: { type: String, default: 'stack', validator: (value) => ['stack', 'inline'].includes(value) },
});
</script>

<template>
    <div class="section-heading" :class="`section-heading--${variant}`">
        <EyebrowText v-if="eyebrow">{{ eyebrow }}</EyebrowText>
        <component :is="`h${level}`" :id="id" class="section-heading__title">{{ title }}</component>
        <p v-if="meta" class="section-heading__meta">{{ meta }}</p>
    </div>
</template>
