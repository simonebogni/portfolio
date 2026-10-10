<script setup lang="ts">
import type { SoftSkill } from '@core/entities/soft-skill';
import { useSourceProfile } from '@designs/source/entities/profile';
import { SoftSkillCard } from '@designs/source/entities/soft-skill';
import { PageHeader } from '@designs/source/shared/ui';
import { Head } from '@inertiajs/vue3';

defineProps<{ softSkills: SoftSkill[] }>();

const { profile } = useSourceProfile();
</script>

<template>
    <div class="page page-soft-skills">
        <Head title="Soft skills" />
        <PageHeader eyebrow="// the parts that don't compile" title="Soft skills" :intro="profile.intros?.soft_skills" />
        <ul class="card-grid card-grid--2 bare-list">
            <SoftSkillCard v-for="(skill, position) in softSkills" :key="skill.id" :skill="skill" :number="position + 1" />
        </ul>
    </div>
</template>
