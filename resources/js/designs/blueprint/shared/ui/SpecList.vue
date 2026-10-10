<script setup lang="ts">
import { computed } from 'vue';
import DraftText from './DraftText.vue';
import { hasValue, type LabelledValue } from './types';

/**
 * Label/value spec sheet (<dl>). `variant`: block (inverted panel) | plain (dashed rows).
 * Empty values are skipped.
 */
const props = withDefaults(
    defineProps<{
        items: readonly LabelledValue[];
        variant?: 'plain' | 'block';
    }>(),
    { variant: 'plain' },
);

const visible = computed(() => props.items.filter(hasValue));
</script>

<template>
    <dl class="spec" :class="`spec--${variant}`">
        <div v-for="item in visible" :key="item.label" class="spec__row">
            <dt>{{ item.label }}</dt>
            <dd><DraftText :text="item.value ?? ''" /></dd>
        </div>
    </dl>
</template>
