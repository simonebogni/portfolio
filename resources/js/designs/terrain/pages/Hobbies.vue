<script setup>
import { Head } from '@inertiajs/vue3';
import PageHeader from '../components/PageHeader.vue';

defineProps({
    hobbies: { type: Array, required: true },
});

const number = (index) => String(index + 1).padStart(2, '0');
</script>

<template>
    <div class="page page-hobbies">
        <Head title="Hobbies" />
        <PageHeader eyebrow="Life outside the IDE" title="Hobbies" intro="What I do when the laptop is closed." />
        <ul class="hobbies plain-list">
            <li v-for="(hobby, index) in hobbies" :key="hobby.id" class="hobby" :class="{ 'hobby--no-image': !hobby.coverImgUrl }">
                <img
                    v-if="hobby.coverImgUrl"
                    class="hobby__image"
                    :src="hobby.coverImgUrl"
                    alt=""
                    width="420"
                    height="315"
                    loading="lazy"
                >
                <div class="hobby__body">
                    <p class="eyebrow" aria-hidden="true">No. {{ number(index) }}</p>
                    <h2 class="hobby__title">{{ hobby.title }}</h2>
                    <p class="hobby__text">{{ hobby.description }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>
