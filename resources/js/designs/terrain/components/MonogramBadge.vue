<script setup>
import { computed } from 'vue';
import { monogram } from '../lib/format';

/** Pebble-shaped badge with up to three initials. Decorative. */
const props = defineProps({
    text: { type: String, required: true },
    size: { type: String, default: 'md', validator: (value) => ['md', 'xl'].includes(value) },
});

const letters = computed(() => monogram(props.text));
</script>

<template>
    <span class="monogram" :class="`monogram--${size}`" aria-hidden="true">{{ letters }}</span>
</template>
