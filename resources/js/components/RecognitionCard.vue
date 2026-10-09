<script setup>
/** A short card with an optional large figure (score, placing) above a serif title. */
defineProps({
    figure: { type: String, default: '' },
    title: { type: String, required: true },
    text: { type: String, default: '' },
});
</script>

<template>
    <article class="recognition-card">
        <p v-if="figure" class="recognition-card__figure">{{ figure }}</p>
        <h3 class="recognition-card__title">{{ title }}</h3>
        <p v-if="text" class="recognition-card__text">{{ text }}</p>
        <slot />
    </article>
</template>
