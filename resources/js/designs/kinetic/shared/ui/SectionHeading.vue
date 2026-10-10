<script setup lang="ts">
/**
 * Section title over a 2px rule, with an optional orange kicker on the right.
 * `id` is what the parent <section aria-labelledby> points to.
 */
withDefaults(
    defineProps<{
        id: string;
        title: string;
        kicker?: string;
        level?: number;
    }>(),
    { kicker: '', level: 2 },
);
</script>

<template>
    <div class="section-heading">
        <component :is="`h${level}`" :id="id" class="section-heading__title display">{{ title }}</component>
        <p v-if="kicker" class="section-heading__kicker label">{{ kicker }}</p>
    </div>
</template>
