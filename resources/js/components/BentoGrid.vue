<script setup>
/** The 12-column bento grid (one column on small screens). Render it as a list with `as="ul"`. */
defineProps({
    as: { type: String, default: 'div' },
});
</script>

<template>
    <component :is="as" class="bento">
        <slot />
    </component>
</template>
