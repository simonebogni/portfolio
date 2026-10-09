<script setup>
/**
 * Magazine "story": a 4:3 picture next to a numbered title and text.
 * `flip` swaps the picture to the right on wide screens.
 */
defineProps({
    title: { type: String, required: true },
    text: { type: String, default: '' },
    numeral: { type: String, default: '' },
    imageUrl: { type: String, default: '' },
    imageAlt: { type: String, default: '' },
    flip: { type: Boolean, default: false },
});
</script>

<template>
    <article class="story" :class="{ 'story--flip': flip, 'story--no-image': !imageUrl }">
        <div class="story__body">
            <span v-if="numeral" class="story__numeral" aria-hidden="true">{{ numeral }}.</span>
            <h2 class="story__title">{{ title }}</h2>
            <p v-if="text" class="story__text">{{ text }}</p>
        </div>
        <figure v-if="imageUrl" class="story__figure">
            <img class="story__image" :src="imageUrl" :alt="imageAlt" width="800" height="600" loading="lazy">
        </figure>
    </article>
</template>
