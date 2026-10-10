<script setup>
import BpIcon from './BpIcon.vue';

/** Card with an icon tile, title and text (the "What I bring" pillars). */
defineProps({
    icon: { type: String, default: '' },
    title: { type: String, required: true },
    level: { type: Number, default: 3 },
});
</script>

<template>
    <div class="feature-card">
        <span v-if="icon" class="feature-card__icon"><BpIcon :name="icon" :size="24" /></span>
        <component :is="`h${level}`" class="feature-card__title">{{ title }}</component>
        <slot />
    </div>
</template>
