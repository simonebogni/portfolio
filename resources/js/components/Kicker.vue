<script setup>
/** Small uppercase overline in the accent colour, above titles. */
defineProps({
    as: { type: String, default: 'p' },
});
</script>

<template>
    <component :is="as" class="kicker"><slot /></component>
</template>
