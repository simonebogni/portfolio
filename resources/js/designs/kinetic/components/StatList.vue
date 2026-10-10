<script setup>
/** A row of big figures with a caption each, e.g. counts on the home page. */
defineProps({
    items: { type: Array, required: true }, // [{ value: string|number, label: string }]
    label: { type: String, default: 'Highlights' },
});
</script>

<template>
    <ul v-if="items.length" class="stats plain-list" :aria-label="label">
        <li v-for="item in items" :key="item.label" class="stats__item">
            <span class="stats__value display">{{ item.value }}</span>
            <span class="stats__label">{{ item.label }}</span>
        </li>
    </ul>
</template>
