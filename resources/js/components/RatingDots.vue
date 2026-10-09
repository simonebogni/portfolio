<script setup>
import { computed } from 'vue';

/**
 * Rating as a row of dots (full, half or empty). The shapes differ, not just the colour,
 * and the whole row is exposed as one image with a text label such as "2.5 out of 5".
 */
const props = defineProps({
    value: { type: Number, required: true },
    max: { type: Number, default: 5 },
});

const dots = computed(() =>
    Array.from({ length: props.max }, (_, index) => {
        const fill = props.value - index;

        return fill >= 1 ? 'full' : fill >= 0.5 ? 'half' : 'empty';
    }),
);
</script>

<template>
    <span class="rating-dots" role="img" :aria-label="`${value} out of ${max}`">
        <span v-for="(dot, index) in dots" :key="index" class="rating-dots__dot" :class="`rating-dots__dot--${dot}`" />
    </span>
</template>
