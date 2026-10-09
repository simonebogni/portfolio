<script setup>
import { Head } from '@inertiajs/vue3';
import PageHeader from '../components/PageHeader.vue';
import SurfaceCard from '../components/SurfaceCard.vue';

defineProps({
    softSkills: { type: Array, required: true },
});

const number = (index) => String(index + 1).padStart(2, '0');
</script>

<template>
    <div class="page page-softskills">
        <Head title="Soft skills" />
        <PageHeader
            eyebrow="Beyond the code"
            title="Soft skills"
            intro="Code is a team sport. These are the habits I bring to every project, from the first analysis to the release."
            layout="split"
        />
        <ul class="grid grid--4 soft-skills plain-list">
            <SurfaceCard
                v-for="(skill, index) in softSkills"
                :key="skill.id"
                as="li"
                :shape="index % 3 === 0 ? 'leaf-flip' : 'leaf'"
                :tone="index === 0 ? 'accent' : 'default'"
                class="soft-skill"
                :class="{ 'soft-skill--feature': index === 0 }"
            >
                <span class="leaf-badge" aria-hidden="true">{{ number(index) }}</span>
                <h2 class="soft-skill__title">{{ skill.name }}</h2>
                <p class="soft-skill__text">{{ skill.description }}</p>
            </SurfaceCard>
        </ul>
    </div>
</template>
