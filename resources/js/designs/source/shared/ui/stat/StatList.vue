<script setup lang="ts">
import BaseCard from '../card/BaseCard.vue';
import type { Stat } from './types';

/** Grid of highlight facts: `items` = [{ value, label }]. */
withDefaults(defineProps<{ items: readonly Stat[]; label?: string }>(), { label: 'Highlights' });
</script>

<template>
    <ul v-if="items.length" class="stats" :aria-label="label">
        <BaseCard v-for="item in items" :key="item.label" as="li" padding="none" class="stat">
            <span class="stat__value">{{ item.value }}</span>
            <span class="stat__label">{{ item.label }}</span>
        </BaseCard>
    </ul>
</template>
