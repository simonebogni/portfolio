<script setup lang="ts">
import { useProfile } from '@core/entities/profile';
import type { SoftSkill } from '@core/entities/soft-skill';
import { pad2 } from '@core/shared/lib';
import type { KineticProfile } from '@designs/kinetic/entities/profile';
import { PageHeader } from '@designs/kinetic/shared/ui';
import { Head } from '@inertiajs/vue3';

/** Props of the Soft skills page (SoftSkillController). */
defineProps<{
    softSkills: SoftSkill[];
}>();

const { profile } = useProfile<KineticProfile>();
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
