<script setup>
import { computed } from 'vue';

/** A value out of `max` drawn as a bar; announced as "4.5 out of 5". */
const props = defineProps({
    value: { type: Number, required: true },
    max: { type: Number, default: 5 },
});

const percent = computed(() => Math.max(0, Math.min(100, (props.value / props.max) * 100)));
</script>

<template>
    <div class="rating-bar" role="img" :aria-label="`${value} out of ${max}`">
        <span class="rating-bar__fill" :style="{ width: `${percent}%` }" />
    </div>
</template>
