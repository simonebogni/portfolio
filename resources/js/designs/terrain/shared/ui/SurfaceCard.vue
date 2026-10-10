<script setup lang="ts">
/**
 * Raised surface with the Terrain shapes.
 * shape: "tile" (even radius), "leaf" (one sharp corner, bottom-left) or "leaf-flip" (sharp top-right).
 * tone: "default" or "accent" (filled olive, for a featured card).
 */
withDefaults(
    defineProps<{
        as?: string;
        shape?: 'tile' | 'leaf' | 'leaf-flip';
        tone?: 'default' | 'accent';
    }>(),
    { as: 'div', shape: 'tile', tone: 'default' },
);
</script>

<template>
    <component :is="as" class="card" :class="[`card--${shape}`, `card--${tone}`]">
        <slot></slot>
    </component>
</template>
