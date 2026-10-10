<script setup lang="ts">
import type { SkillCategory } from '@core/entities/skill';
import { SkillCard } from '@designs/terrain/entities/skill';
import { SectionHeading } from '@designs/terrain/shared/ui';

/** "What I build with": one card per skill category. */
defineProps<{
    categories: SkillCategory[];
}>();
</script>

<template>
    <section class="page-section" aria-labelledby="skills-title">
        <SectionHeading id="skills-title" eyebrow="Toolbox" title="What I build with" />
        <ul class="grid grid--3 grid--fill-last plain-list">
            <SkillCard v-for="category in categories" :key="category.id" :category="category" />
        </ul>
    </section>
</template>
