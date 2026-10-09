<script setup>
/** Small uppercase rust label above a heading. */
defineProps({
    as: { type: String, default: 'p' },
});
</script>

<template>
    <component :is="as" class="eyebrow"><slot /></component>
</template>
