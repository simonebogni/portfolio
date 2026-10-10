<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';
import { pad2 } from '@core/shared/lib';

/** A numbered hobby row with its photo. A list item; rows alternate sides with CSS. */
defineProps<{
    hobby: Hobby;
    index: number;
}>();
</script>

<template>
    <li class="hobby" :class="{ 'hobby--no-image': !hobby.coverImgUrl }">
        <img
            v-if="hobby.coverImgUrl"
            class="hobby__image"
            :src="hobby.coverImgUrl"
            alt=""
            width="420"
            height="315"
            loading="lazy"
        />
        <div class="hobby__body">
            <p class="eyebrow" aria-hidden="true">No. {{ pad2(index + 1) }}</p>
            <h2 class="hobby__title">{{ hobby.title }}</h2>
            <p class="hobby__text">{{ hobby.description }}</p>
        </div>
    </li>
</template>
