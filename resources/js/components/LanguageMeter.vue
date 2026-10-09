<script setup>
import { computed } from 'vue';

/**
 * A spoken language with its level in words and a 0–5 bar.
 * The bar repeats the text for sighted users; screen readers get "x out of 5".
 */
const props = defineProps({
    name: { type: String, required: true },
    level: { type: String, required: true },
    rating: { type: Number, required: true },
    max: { type: Number, default: 5 },
});

const percent = computed(() => `${Math.min(Math.max(props.rating / props.max, 0), 1) * 100}%`);
</script>

<template>
    <li class="lang">
        <span class="lang__name">{{ name }}</span>
        <span class="lang__level">{{ level }}</span>
        <span class="lang__meter" role="img" :aria-label="`${rating} out of ${max}`">
            <span class="lang__fill" :style="{ width: percent }" />
        </span>
    </li>
</template>
