<script setup>
/**
 * Section title with a muted code comment next to it. Pass the same `id` to
 * the section's aria-labelledby. The comment is decorative (hidden from screen readers).
 */
defineProps({
    id: { type: String, required: true },
    title: { type: String, required: true },
    comment: { type: String, default: null },
    level: { type: Number, default: 2 },
    size: { type: String, default: 'md', validator: (value) => ['md', 'sm'].includes(value) },
});
</script>

<template>
    <div class="section-heading" :class="{ 'section-heading--sm': size === 'sm' }">
        <component :is="`h${level}`" :id="id" class="section-heading__title">{{ title }}</component>
        <p v-if="comment" class="section-heading__comment" aria-hidden="true">// {{ comment }}</p>
    </div>
</template>
