<script setup>
/** Row of big numbers with labels, e.g. counts of projects and certificates. */
defineProps({
    items: { type: Array, required: true }, // [{ value, label }]
    label: { type: String, default: 'Highlights' },
});
</script>

<template>
    <ul class="stats" :aria-label="label">
        <li v-for="item in items" :key="item.label" class="stats__item">
            <span class="stats__value">{{ item.value }}</span>
            <span class="stats__label">{{ item.label }}</span>
        </li>
    </ul>
</template>
