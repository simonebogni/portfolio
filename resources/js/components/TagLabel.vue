<script setup>
import BpIcon from './BpIcon.vue';

/** Mono "kicker" pill above titles, e.g. "Tech Lead · Tel Aviv". */
defineProps({
    dot: { type: Boolean, default: false },
});
</script>

<template>
    <p class="tag"><BpIcon v-if="dot" name="dot" :size="14" /><slot /></p>
</template>
