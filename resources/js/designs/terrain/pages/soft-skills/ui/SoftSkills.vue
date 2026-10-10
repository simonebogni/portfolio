<script setup lang="ts">
import { SoftSkillCard } from '@designs/terrain/entities/soft-skill';
import { PageHeader } from '@designs/terrain/shared/ui';
import { Head } from '@inertiajs/vue3';
import type { SoftSkillsProps } from '../model/props';

defineProps<SoftSkillsProps>();
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
            <SoftSkillCard v-for="(skill, index) in softSkills" :key="skill.id" :skill="skill" :index="index" />
        </ul>
    </div>
</template>
