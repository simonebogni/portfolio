<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseCard from '../components/BaseCard.vue';
import PageHeader from '../components/PageHeader.vue';

defineProps({
    softSkills: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);

function index(position) {
    return String(position + 1).padStart(2, '0');
}
</script>

<template>
    <div class="page page-soft-skills">
        <Head title="Soft skills" />
        <PageHeader eyebrow="// the parts that don't compile" title="Soft skills" :intro="profile.intros?.soft_skills" />
        <ul class="card-grid card-grid--2 bare-list">
            <BaseCard v-for="(skill, position) in softSkills" :key="skill.id" as="li" padding="lg" class="soft-skill">
                <span class="badge" aria-hidden="true">{{ index(position) }}</span>
                <div>
                    <h2 class="soft-skill__name">{{ skill.name }}</h2>
                    <p class="card-text">{{ skill.description }}</p>
                </div>
            </BaseCard>
        </ul>
    </div>
</template>
