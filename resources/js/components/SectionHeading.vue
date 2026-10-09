<script setup>
/**
 * Two-column section heading: mono index/kicker on the left, title on the right.
 * Pass the same `id` as the section's aria-labelledby.
 */
defineProps({
    id: { type: String, required: true },
    kicker: { type: String, required: true },
    title: { type: String, required: true },
    level: { type: Number, default: 2 },
});
</script>

<template>
    <div class="section-heading">
        <p class="section-heading__kicker">{{ kicker }}</p>
        <component :is="`h${level}`" :id="id" class="section-heading__title">{{ title }}</component>
    </div>
</template>
