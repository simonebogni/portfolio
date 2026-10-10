<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';

/** A hobby card: decorative photo, optional kind, title, description and what it teaches. */
withDefaults(
    defineProps<{
        hobby: Hobby;
        kind?: string;
        lesson?: string;
    }>(),
    { kind: '', lesson: '' },
);
</script>

<template>
    <li class="hobby">
        <img
            v-if="hobby.coverImgUrl"
            class="hobby__image"
            :src="hobby.coverImgUrl"
            alt=""
            width="400"
            height="230"
            loading="lazy"
        />
        <div class="hobby__body">
            <span v-if="kind" class="kicker">{{ kind }}</span>
            <h2 class="hobby__title">{{ hobby.title }}</h2>
            <p>{{ hobby.description }}</p>
            <p v-if="lesson" class="hobby__lesson">
                <b>What it teaches</b>{{ lesson }}
            </p>
        </div>
    </li>
</template>
