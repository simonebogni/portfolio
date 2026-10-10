<script setup>
/** A section title inside a tile, with optional monospace meta text aligned to the right. */
defineProps({
    id: { type: String, required: true },
    level: { type: Number, default: 2 },
    meta: { type: String, default: null },
});
</script>

<template>
    <div class="tile-heading">
        <component :is="`h${level}`" :id="id" class="tile-heading__title"><slot /></component>
        <p v-if="meta" class="tile-label">{{ meta }}</p>
    </div>
</template>
