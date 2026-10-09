<script setup>
import { computed } from 'vue';
import { padNumber } from '../lib/copy';

/**
 * An ordered list with large italic counters (01, 02, ...).
 * - grid: two columns of compact items (principles band)
 * - wide: one item per row, counter / title / text (soft skills)
 * Items: { title, text, label? }. `tone="deep"` is for dark bands.
 */
const props = defineProps({
    items: { type: Array, required: true },
    variant: { type: String, default: 'grid', validator: (value) => ['grid', 'wide'].includes(value) },
    tone: { type: String, default: 'default', validator: (value) => ['default', 'deep'].includes(value) },
    headingLevel: { type: Number, default: 3 },
});

const heading = computed(() => `h${props.headingLevel}`);
</script>

<template>
    <ol class="numbered-list" :class="[`numbered-list--${variant}`, `numbered-list--${tone}`]">
        <li v-for="(item, index) in items" :key="item.title" class="numbered-list__item">
            <span class="numbered-list__counter" aria-hidden="true">{{ padNumber(index + 1) }}</span>
            <component :is="heading" class="numbered-list__title">{{ item.title }}</component>
            <p class="numbered-list__text">
                {{ item.text }}
                <small v-if="item.label" class="numbered-list__label">{{ item.label }}</small>
            </p>
        </li>
    </ol>
</template>
