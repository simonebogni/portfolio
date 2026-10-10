<script setup>
import { computed } from 'vue';
import DraftText from './DraftText.vue';

/**
 * Label/value spec sheet (<dl>). `variant`: block (inverted panel) | plain (dashed rows).
 * Items: { label, value }; empty values are skipped.
 */
const props = defineProps({
    items: { type: Array, required: true },
    variant: { type: String, default: 'plain' },
});

const visible = computed(() =>
    props.items.filter((item) => item.value !== null && item.value !== undefined && item.value !== ''),
);
</script>

<template>
    <dl class="spec" :class="`spec--${variant}`">
        <div v-for="item in visible" :key="item.label" class="spec__row">
            <dt>{{ item.label }}</dt>
            <dd><DraftText :text="item.value" /></dd>
        </div>
    </dl>
</template>
