<script setup>
/**
 * Raised surface with the Terrain shapes.
 * shape: "tile" (even radius), "leaf" (one sharp corner, bottom-left) or "leaf-flip" (sharp top-right).
 * tone: "default" or "accent" (filled olive, for a featured card).
 */
defineProps({
    as: { type: String, default: 'div' },
    shape: { type: String, default: 'tile', validator: (value) => ['tile', 'leaf', 'leaf-flip'].includes(value) },
    tone: { type: String, default: 'default', validator: (value) => ['default', 'accent'].includes(value) },
});
</script>

<template>
    <component :is="as" class="card" :class="[`card--${shape}`, `card--${tone}`]">
        <slot />
    </component>
</template>
