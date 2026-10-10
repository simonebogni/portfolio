<script setup lang="ts">
import type { StatItem } from './types';

/** A row of big figures with a caption each, e.g. counts on the home page. */
withDefaults(
    defineProps<{
        items: readonly StatItem[];
        label?: string;
    }>(),
    { label: 'Highlights' },
);
</script>

<template>
    <ul v-if="items.length" class="stats plain-list" :aria-label="label">
        <li v-for="item in items" :key="item.label" class="stats__item">
            <span class="stats__value display">{{ item.value }}</span>
            <span class="stats__label">{{ item.label }}</span>
        </li>
    </ul>
</template>
