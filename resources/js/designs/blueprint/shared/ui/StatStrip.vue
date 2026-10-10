<script setup lang="ts">
import { computed } from 'vue';
import { hasValue, type LabelledValue } from './types';

/** Row of big numbers with mono captions; empty values are skipped. */
const props = withDefaults(
    defineProps<{
        items: readonly LabelledValue[];
        label?: string;
    }>(),
    { label: 'Highlights' },
);

const visible = computed(() => props.items.filter(hasValue));
</script>

<template>
    <ul class="stats" :aria-label="label">
        <li v-for="item in visible" :key="item.label" class="stats__item">
            <b class="stats__value">{{ item.value }}</b>
            <span class="stats__label">{{ item.label }}</span>
        </li>
    </ul>
</template>
