<script setup lang="ts">
import { computed } from 'vue';
import { monogram } from '../lib';

/** Pebble-shaped badge with up to three initials. Decorative. */
const props = withDefaults(
    defineProps<{
        text: string;
        size?: 'md' | 'xl';
    }>(),
    { size: 'md' },
);

const letters = computed(() => monogram(props.text));
</script>

<template>
    <span class="monogram" :class="`monogram--${size}`" aria-hidden="true">{{ letters }}</span>
</template>
