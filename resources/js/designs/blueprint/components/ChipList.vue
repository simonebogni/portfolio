<script setup>
/** Small mono chips, e.g. technologies. `variant`: outline | soft. */
defineProps({
    items: { type: Array, required: true },
    label: { type: String, required: true },
    variant: { type: String, default: 'outline' },
});
</script>

<template>
    <ul v-if="items.length" class="chips" :class="`chips--${variant}`" :aria-label="label">
        <li v-for="item in items" :key="item">{{ item }}</li>
    </ul>
</template>
