<script setup lang="ts">
/** Announces the filter result to screen readers (polite live region). */
defineProps<{
    text: string;
}>();
</script>

<template>
    <p class="visually-hidden" role="status" aria-live="polite" aria-atomic="true">{{ text }}</p>
</template>
