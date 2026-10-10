<script setup lang="ts">
/**
 * Bordered surface. `as` sets the element (article, li, div…), `padding` is
 * none | md | lg, and `dashed` marks content still to be written.
 */
withDefaults(defineProps<{ as?: string; padding?: 'none' | 'md' | 'lg'; dashed?: boolean }>(), { as: 'div', padding: 'md' });
</script>

<template>
    <component :is="as" class="card" :class="[padding === 'none' ? 'card--flush' : `card--pad-${padding}`, { 'card--dashed': dashed }]">
        <slot></slot>
    </component>
</template>
