<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageHeader from '../components/PageHeader.vue';
import { pad2 } from '../lib/format';

defineProps({
    softSkills: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
</script>

<template>
    <div class="page page--soft-skills container">
        <Head title="Soft skills" />
        <PageHeader title="Soft " accent="skills." :intro="profile.intros?.soft_skills" layout="grid" accent-block />
        <ol class="numbered-rows plain-list">
            <li v-for="(skill, index) in softSkills" :key="skill.id" class="numbered-rows__item" :class="{ 'numbered-rows__item--accent': index === 0 }">
                <span class="numbered-rows__index display" aria-hidden="true">{{ pad2(index + 1) }}</span>
                <h2 class="numbered-rows__title display">{{ skill.name }}</h2>
                <p class="numbered-rows__text">{{ skill.description }}</p>
            </li>
        </ol>
    </div>
</template>
