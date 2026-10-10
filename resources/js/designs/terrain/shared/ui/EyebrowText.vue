<script setup lang="ts">
/** Small uppercase rust label above a heading. */
const { as = 'p' } = defineProps<{
    as?: string;
}>();
</script>

<template>
    <component :is="as" class="eyebrow"><slot></slot></component>
</template>
