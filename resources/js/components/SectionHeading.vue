<script setup>
/** Section title with a rule above it and a small label on the right. */
defineProps({
    id: { type: String, required: true },
    title: { type: String, required: true },
    kicker: { type: String, default: '' },
    size: { type: String, default: 'lg', validator: (value) => ['lg', 'md'].includes(value) },
});
</script>

<template>
    <div class="section-heading" :class="`section-heading--${size}`">
        <h2 :id="id" class="section-heading__title">{{ title }}</h2>
        <p v-if="kicker" class="section-heading__kicker">{{ kicker }}</p>
    </div>
</template>
