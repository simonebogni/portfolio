<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';
import { BentoGrid, BentoTile, PageIntro } from '@designs/bento/shared/ui';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { hobbyCards, leadHobby } from '../model/cards';

const props = defineProps<{ hobbies: Hobby[] }>();

const lead = computed(() => leadHobby(props.hobbies));
const cards = computed(() => hobbyCards(props.hobbies, lead.value));
</script>

<template>
    <div class="page page-hobbies">
        <Head title="Hobbies" />
        <BentoGrid>
            <PageIntro :span="lead ? 5 : 12" class="intro--bottom" label="Hobbies" title="Off the clock" lead="What I do when the laptop is closed." />
            <div v-if="lead" class="tile tile--span-7 photo">
                <img :src="lead.coverImgUrl ?? undefined" :alt="`Photo for ${lead.title}`" loading="eager" />
            </div>
            <BentoTile
                v-for="card in cards"
                :key="card.hobby.id"
                as="article"
                :span="card.span"
                padding="none"
                class="hobby"
                :class="[`hobby--${card.layout}`, { 'hobby--text': !card.showImage }]"
                :aria-labelledby="`hobby-${card.hobby.id}`"
            >
                <img v-if="card.showImage" class="hobby__img" :src="card.hobby.coverImgUrl ?? undefined" alt="" loading="lazy" />
                <div class="hobby__text">
                    <p class="tile-label">{{ card.number }}</p>
                    <h2 :id="`hobby-${card.hobby.id}`" class="tile-title">{{ card.hobby.title }}</h2>
                    <p class="muted">{{ card.hobby.description }}</p>
                </div>
            </BentoTile>
        </BentoGrid>
    </div>
</template>
