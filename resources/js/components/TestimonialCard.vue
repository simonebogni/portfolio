<script setup>
import { computed } from 'vue';
import { isPlaceholder } from '../lib/copy';

/** A quote with its author. Placeholder quotes (with [BRACKETS]) get a dashed outline. */
const props = defineProps({
    quote: { type: String, required: true },
    name: { type: String, required: true },
    role: { type: String, default: '' },
});

const placeholder = computed(() => isPlaceholder(props.quote, props.name, props.role));
</script>

<template>
    <figure class="testimonial" :class="{ 'testimonial--placeholder': placeholder }">
        <blockquote class="testimonial__quote">“{{ quote }}”</blockquote>
        <figcaption class="testimonial__author">
            {{ name }}
            <span v-if="role">{{ role }}</span>
        </figcaption>
    </figure>
</template>
