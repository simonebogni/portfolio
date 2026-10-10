<script setup>
/**
 * Section title over a 2px rule, with an optional orange kicker on the right.
 * `id` is what the parent <section aria-labelledby> points to.
 */
defineProps({
    id: { type: String, required: true },
    title: { type: String, required: true },
    kicker: { type: String, default: '' },
    level: { type: Number, default: 2 },
});
</script>

<template>
    <div class="section-heading">
        <component :is="`h${level}`" :id="id" class="section-heading__title display">{{ title }}</component>
        <p v-if="kicker" class="section-heading__kicker label">{{ kicker }}</p>
    </div>
</template>
