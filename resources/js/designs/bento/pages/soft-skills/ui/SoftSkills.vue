<script setup lang="ts">
import type { SoftSkill } from '@core/entities/soft-skill';
import { BentoGrid, BentoTile, Icon, PageIntro } from '@designs/bento/shared/ui';
import { Head } from '@inertiajs/vue3';
import { iconFor, spanFor } from '../model/tiles';

defineProps<{ softSkills: SoftSkill[] }>();
</script>

<template>
    <div class="page page-softskills">
        <Head title="Soft skills" />
        <BentoGrid as="div">
            <PageIntro
                :span="8"
                class="intro--bottom"
                title="Soft skills"
                lead="The habits I bring to every project, from the first analysis to the release."
            />
            <BentoTile
                v-for="(skill, index) in softSkills"
                :key="skill.id"
                as="section"
                :span="spanFor(index, softSkills.length)"
                :tone="index === 0 ? 'inverse' : 'surface'"
                class="skill"
                :aria-labelledby="`skill-${skill.id}`"
            >
                <span class="skill__icon" aria-hidden="true"><Icon :name="iconFor(skill.name, index)" :size="24" /></span>
                <h2 :id="`skill-${skill.id}`" class="tile-title tile-title--sm">{{ skill.name }}</h2>
                <p>{{ skill.description }}</p>
            </BentoTile>
        </BentoGrid>
    </div>
</template>
