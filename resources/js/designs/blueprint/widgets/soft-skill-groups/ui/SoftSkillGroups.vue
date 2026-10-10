<script setup lang="ts">
import { type SoftSkillGroup, SoftSkillGroupCard } from '@designs/blueprint/entities/soft-skill';
import { SectionHeading } from '@designs/blueprint/shared/ui';

/** "Soft skills": the habits behind the working model, one card per group. */
defineProps<{
    groups: readonly SoftSkillGroup[];
    /** Section number, e.g. "02". */
    number: string;
}>();
</script>

<template>
    <section v-if="groups.length" class="section" aria-labelledby="skills-title">
        <SectionHeading
            id="skills-title"
            :kicker="`${number} · Soft skills`"
            title="The habits behind it"
        />
        <div class="card-grid card-grid--3">
            <SoftSkillGroupCard v-for="group in groups" :key="group.name" :group="group" />
        </div>
    </section>
</template>
