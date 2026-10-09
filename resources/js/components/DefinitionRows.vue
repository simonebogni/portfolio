<script setup>
/**
 * Term/detail pairs separated by hairlines.
 * - rows: term and detail side by side (stacked on small screens)
 * - stacked: small muted term above a serif detail
 * - deep: like stacked, for dark bands
 */
defineProps({
    items: { type: Array, required: true },
    variant: { type: String, default: 'rows', validator: (value) => ['rows', 'stacked', 'deep'].includes(value) },
});
</script>

<template>
    <dl class="definition-rows" :class="`definition-rows--${variant}`">
        <div v-for="item in items" :key="item.term" class="definition-rows__row">
            <dt>{{ item.term }}</dt>
            <dd :class="{ 'is-placeholder': item.placeholder }">{{ item.detail }}</dd>
        </div>
    </dl>
</template>
