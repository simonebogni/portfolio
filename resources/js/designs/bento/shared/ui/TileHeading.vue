<script setup lang="ts">
/** A section title inside a tile, with optional monospace meta text aligned to the right. */
withDefaults(defineProps<{ id: string; level?: number; meta?: string | null }>(), { level: 2, meta: null });
</script>

<template>
    <div class="tile-heading">
        <component :is="`h${level}`" :id="id" class="tile-heading__title"><slot></slot></component>
        <p v-if="meta" class="tile-label">{{ meta }}</p>
    </div>
</template>
