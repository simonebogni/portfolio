<script setup>
/** A list of technology tags. `label` names the list for screen readers. */
defineProps({
    items: { type: Array, required: true },
    label: { type: String, default: 'Technologies' },
});
</script>

<template>
    <ul v-if="items.length" class="chips" :aria-label="label">
        <li v-for="item in items" :key="item" class="chip">{{ item }}</li>
    </ul>
</template>
