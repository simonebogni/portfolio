<script setup>
import BaseCard from './BaseCard.vue';

/** Grid of highlight facts: `items` = [{ value, label }]. */
defineProps({
    items: { type: Array, required: true },
    label: { type: String, default: 'Highlights' },
});
</script>

<template>
    <ul v-if="items.length" class="stats" :aria-label="label">
        <BaseCard v-for="item in items" :key="item.label" as="li" padding="none" class="stat">
            <span class="stat__value">{{ item.value }}</span>
            <span class="stat__label">{{ item.label }}</span>
        </BaseCard>
    </ul>
</template>
