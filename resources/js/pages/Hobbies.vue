<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    hobbies: { type: Array, required: true },
});
</script>

<template>
    <div class="page">
        <Head title="Hobbies" />
        <h1>Hobbies</h1>
        <ul>
            <li v-for="hobby in hobbies" :key="hobby.id">
                <img v-if="hobby.coverImgUrl" :src="hobby.coverImgUrl" alt="" width="320" height="200" loading="lazy">
                <h2>{{ hobby.title }}</h2>
                <p>{{ hobby.description }}</p>
            </li>
        </ul>
    </div>
</template>
