<script setup>
/** Row of big numbers with mono captions. Items: { value, label }; empty values are skipped. */
const props = defineProps({
    items: { type: Array, required: true },
    label: { type: String, default: 'Highlights' },
});
</script>

<template>
    <ul class="stats" :aria-label="label">
        <li v-for="item in props.items.filter((i) => i.value !== null && i.value !== undefined && i.value !== '')" :key="item.label" class="stats__item">
            <b class="stats__value">{{ item.value }}</b>
            <span class="stats__label">{{ item.label }}</span>
        </li>
    </ul>
</template>
