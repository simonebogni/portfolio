<script setup>
/**
 * Bordered surface. `as` sets the element (article, li, div…), `padding` is
 * none | md | lg, and `dashed` marks content still to be written.
 */
defineProps({
    as: { type: String, default: 'div' },
    padding: { type: String, default: 'md', validator: (value) => ['none', 'md', 'lg'].includes(value) },
    dashed: { type: Boolean, default: false },
});
</script>

<template>
    <component :is="as" class="card" :class="[padding === 'none' ? 'card--flush' : `card--pad-${padding}`, { 'card--dashed': dashed }]">
        <slot />
    </component>
</template>
