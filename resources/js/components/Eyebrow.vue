<script setup>
/** Small uppercase label above a title. */
defineProps({
    tone: { type: String, default: 'accent', validator: (value) => ['accent', 'muted', 'deep'].includes(value) },
});
</script>

<template>
    <p class="eyebrow" :class="`eyebrow--${tone}`"><slot /></p>
</template>
