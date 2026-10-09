<script setup>
/** A row of small rounded labels (technologies, scope). */
defineProps({
    items: { type: Array, required: true },
    label: { type: String, required: true },
});
</script>

<template>
    <ul v-if="items.length" class="chip-list" :aria-label="label">
        <li v-for="item in items" :key="item" class="chip">{{ item }}</li>
    </ul>
</template>
