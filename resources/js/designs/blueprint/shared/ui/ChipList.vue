<script setup lang="ts">
/** Small mono chips, e.g. technologies. `variant`: outline | soft. */
withDefaults(
    defineProps<{
        items: readonly string[];
        label: string;
        variant?: 'outline' | 'soft';
    }>(),
    { variant: 'outline' },
);
</script>

<template>
    <ul v-if="items.length" class="chips" :class="`chips--${variant}`" :aria-label="label">
        <li v-for="item in items" :key="item">{{ item }}</li>
    </ul>
</template>
