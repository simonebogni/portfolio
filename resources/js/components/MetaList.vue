<script setup>
/** Inline list of short values separated by middle dots (technologies, tags, platforms). */
defineProps({
    items: { type: Array, required: true },
    label: { type: String, default: '' },
});
</script>

<template>
    <ul v-if="items.length" class="meta-list" :aria-label="label || undefined">
        <li v-for="item in items" :key="item">{{ item }}</li>
    </ul>
</template>
