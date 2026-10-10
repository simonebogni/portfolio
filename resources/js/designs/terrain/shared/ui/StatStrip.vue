<script setup lang="ts">
export interface Stat {
    value: number | string;
    label: string;
}

/** Row of big numbers with labels, e.g. counts of projects and certificates. */
withDefaults(
    defineProps<{
        items: Stat[];
        label?: string;
    }>(),
    { label: 'Highlights' },
);
</script>

<template>
    <ul class="stats" :aria-label="label">
        <li v-for="item in items" :key="item.label" class="stats__item">
            <span class="stats__value">{{ item.value }}</span>
            <span class="stats__label">{{ item.label }}</span>
        </li>
    </ul>
</template>
