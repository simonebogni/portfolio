<script setup lang="ts">
import BentoTile from './BentoTile.vue';
import TileLabel from './TileLabel.vue';

/** The page header tile: optional eyebrow, the page's single <h1> and a lead paragraph. */
withDefaults(
    defineProps<{
        title: string;
        label?: string | null;
        lead?: string | null;
        span?: number;
        as?: string;
    }>(),
    { label: null, lead: null, span: 12, as: 'header' },
);
</script>

<template>
    <BentoTile :as="as" :span="span" padding="lg" class="intro">
        <TileLabel v-if="label" as="p">{{ label }}</TileLabel>
        <h1 class="display">{{ title }}</h1>
        <p v-if="lead" class="lead">{{ lead }}</p>
        <slot></slot>
    </BentoTile>
</template>
