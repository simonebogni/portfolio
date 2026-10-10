<script setup>
import { computed } from 'vue';

/**
 * A rating drawn as five outlined blocks, filled in orange (half blocks allowed).
 * Exposed to assistive technology as one image with a "x out of 5" label; the
 * filled/outlined shapes carry the value, so it does not rely on colour.
 */
const props = defineProps({
    value: { type: Number, required: true },
    max: { type: Number, default: 5 },
});

const blocks = computed(() =>
    Array.from({ length: props.max }, (_, index) => {
        const fill = Math.max(0, Math.min(1, props.value - index));

        return fill >= 1 ? 'full' : fill > 0 ? 'half' : 'empty';
    }),
);
</script>

<template>
    <div class="rating" role="img" :aria-label="`${value} out of ${max}`">
        <span v-for="(state, index) in blocks" :key="index" class="rating__block" :class="`rating__block--${state}`" />
    </div>
</template>
