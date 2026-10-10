<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageHeader from '../components/PageHeader.vue';
import { pad2 } from '../lib/format';

defineProps({
    hobbies: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
</script>

<template>
    <div class="page page--hobbies container">
        <Head title="Hobbies" />
        <PageHeader title="Off" accent="line." :intro="profile.intros?.hobbies" :ruled="false" />
        <ul class="hobby-grid plain-list">
            <li v-for="(hobby, index) in hobbies" :key="hobby.id" class="hobby-card" :class="{ 'hobby-card--accent': index % 3 === 1 }">
                <!-- The photo illustrates the title next to it, so it is decorative. -->
                <img v-if="hobby.coverImgUrl" class="hobby-card__image" :src="hobby.coverImgUrl" alt="" width="400" height="400" loading="lazy">
                <div class="hobby-card__body">
                    <span class="hobby-card__index display" aria-hidden="true">{{ pad2(index + 1) }}</span>
                    <h2 class="hobby-card__title display">{{ hobby.title }}</h2>
                    <p class="hobby-card__text">{{ hobby.description }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>
