<script setup>
/** A hobby with its photo. The first card of the grid is `featured` (taller image). */
defineProps({
    hobby: { type: Object, required: true },
    featured: { type: Boolean, default: false },
});
</script>

<template>
    <li class="hobby-card" :class="{ 'hobby-card--featured': featured }">
        <figure class="hobby-card__figure">
            <img
                v-if="hobby.coverImgUrl"
                class="hobby-card__image"
                :src="hobby.coverImgUrl"
                alt=""
                width="640"
                :height="featured ? 800 : 400"
                :loading="featured ? 'eager' : 'lazy'"
            >
            <figcaption>
                <h2 class="hobby-card__title">{{ hobby.title }}</h2>
                <p class="hobby-card__text">{{ hobby.description }}</p>
            </figcaption>
        </figure>
    </li>
</template>
