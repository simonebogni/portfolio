<script setup>
/** Vertical timeline; put TimelineEntry components inside. */
defineProps({
    label: { type: String, default: null },
});
</script>

<template>
    <ol class="timeline" :aria-label="label">
        <slot />
    </ol>
</template>
