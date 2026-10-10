<script setup lang="ts">
import BpIcon from './BpIcon.vue';

/** Mono "kicker" pill above titles, e.g. "Tech Lead · Tel Aviv". */
defineProps<{
    dot?: boolean;
}>();
</script>

<template>
    <p class="tag"><BpIcon v-if="dot" name="dot" :size="14" /><slot></slot></p>
</template>
