<script setup lang="ts">
/** Monospace uppercase eyebrow label used at the top of tiles. */
withDefaults(defineProps<{ as?: string }>(), { as: 'p' });
</script>

<template>
    <component :is="as" class="tile-label"><slot></slot></component>
</template>
