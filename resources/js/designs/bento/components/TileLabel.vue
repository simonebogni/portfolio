<script setup>
/** Monospace uppercase eyebrow label used at the top of tiles. */
defineProps({
    as: { type: String, default: 'p' },
});
</script>

<template>
    <component :is="as" class="tile-label"><slot /></component>
</template>
