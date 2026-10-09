<script setup>
import { Head } from '@inertiajs/vue3';
import HobbyCard from '../components/HobbyCard.vue';
import PageHeader from '../components/PageHeader.vue';

defineProps({
    hobbies: { type: Array, required: true },
});
</script>

<template>
    <div class="page page-hobbies wrap">
        <Head title="Hobbies" />
        <PageHeader eyebrow="Hobbies" title="Away from the desk." lede="What I do when the laptop is closed." />
        <ul class="hobby-grid">
            <HobbyCard v-for="(hobby, index) in hobbies" :key="hobby.id" :hobby="hobby" :featured="index === 0" />
        </ul>
    </div>
</template>
