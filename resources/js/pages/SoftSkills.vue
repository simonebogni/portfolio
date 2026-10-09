<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    softSkills: { type: Array, required: true },
});
</script>

<template>
    <div class="page">
        <Head title="Soft skills" />
        <h1>Soft skills</h1>
        <ul>
            <li v-for="skill in softSkills" :key="skill.id">
                <h2>{{ skill.name }}</h2>
                <p>{{ skill.description }}</p>
            </li>
        </ul>
    </div>
</template>
