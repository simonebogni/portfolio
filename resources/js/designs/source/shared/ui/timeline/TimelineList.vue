<script setup lang="ts">
/** Vertical timeline; put TimelineEntry components inside. */
withDefaults(defineProps<{ label?: string | null }>(), { label: null });
</script>

<template>
    <ol class="timeline" :aria-label="label ?? undefined">
        <slot></slot>
    </ol>
</template>
