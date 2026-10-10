<script setup lang="ts">
/**
 * Section title with a muted code comment next to it. Pass the same `id` to
 * the section's aria-labelledby. The comment is decorative (hidden from screen readers).
 */
withDefaults(defineProps<{ id: string; title: string; comment?: string | null; level?: number; size?: 'md' | 'sm' }>(), {
    comment: null,
    level: 2,
    size: 'md',
});
</script>

<template>
    <div class="section-heading" :class="{ 'section-heading--sm': size === 'sm' }">
        <component :is="`h${level}`" :id="id" class="section-heading__title">{{ title }}</component>
        <p v-if="comment" class="section-heading__comment" aria-hidden="true">// {{ comment }}</p>
    </div>
</template>
