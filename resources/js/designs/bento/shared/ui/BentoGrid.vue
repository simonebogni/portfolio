<script setup lang="ts">
/** The 12-column bento grid (one column on small screens). Render it as a list with `as="ul"`. */
withDefaults(defineProps<{ as?: string }>(), { as: 'div' });
</script>

<template>
    <component :is="as" class="bento">
        <slot></slot>
    </component>
</template>
