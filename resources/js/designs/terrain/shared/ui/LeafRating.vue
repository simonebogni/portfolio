<script setup lang="ts">
import { computed } from 'vue';

/**
 * A 0–max rating drawn as a row of leaf bars; half points fill half a bar.
 * Exposed to assistive technology as an image with a text label.
 */
const props = withDefaults(
    defineProps<{
        value: number;
        max?: number;
        label?: string | null;
    }>(),
    { max: 5, label: null },
);

type LeafState = 'full' | 'half' | 'empty';

const segments = computed<LeafState[]>(() =>
    Array.from({ length: props.max }, (_, index) => {
        const fill = Math.min(Math.max(props.value - index, 0), 1);

        return fill >= 1 ? 'full' : fill > 0 ? 'half' : 'empty';
    }),
);
</script>

<template>
    <div class="rating" role="img" :aria-label="label ?? `${value} out of ${max}`">
        <span v-for="(state, index) in segments" :key="index" class="rating__leaf" :class="`rating__leaf--${state}`"></span>
    </div>
</template>
