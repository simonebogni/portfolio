<script setup>
import { computed } from 'vue';

/**
 * A 0–max rating drawn as a row of leaf bars; half points fill half a bar.
 * Exposed to assistive technology as an image with a text label.
 */
const props = defineProps({
    value: { type: Number, required: true },
    max: { type: Number, default: 5 },
    label: { type: String, default: null },
});

const segments = computed(() =>
    Array.from({ length: props.max }, (_, index) => {
        const fill = Math.min(Math.max(props.value - index, 0), 1);

        return fill >= 1 ? 'full' : fill > 0 ? 'half' : 'empty';
    }),
);
</script>

<template>
    <div class="rating" role="img" :aria-label="label ?? `${value} out of ${max}`">
        <span v-for="(state, index) in segments" :key="index" class="rating__leaf" :class="`rating__leaf--${state}`" />
    </div>
</template>
