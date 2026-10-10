<script setup>
import BentoTile from './BentoTile.vue';
import TileLabel from './TileLabel.vue';

/** The page header tile: optional eyebrow, the page's single <h1> and a lead paragraph. */
defineProps({
    title: { type: String, required: true },
    label: { type: String, default: null },
    lead: { type: String, default: null },
    span: { type: Number, default: 12 },
    as: { type: String, default: 'header' },
});
</script>

<template>
    <BentoTile :as="as" :span="span" padding="lg" class="intro">
        <TileLabel v-if="label" as="p">{{ label }}</TileLabel>
        <h1 class="display">{{ title }}</h1>
        <p v-if="lead" class="lead">{{ lead }}</p>
        <slot />
    </BentoTile>
</template>
