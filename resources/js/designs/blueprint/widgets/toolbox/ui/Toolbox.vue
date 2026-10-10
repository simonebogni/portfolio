<script setup lang="ts">
import type { SkillCategory } from '@core/entities/skill';
import { SkillCategoryItem } from '@designs/blueprint/entities/skill';
import { SectionHeading } from '@designs/blueprint/shared/ui';

/** "Toolbox": the programming knowledge, one grid cell per skill category. */
defineProps<{
    skillCategories: readonly SkillCategory[];
}>();
</script>

<template>
    <section v-if="skillCategories.length" class="section" aria-labelledby="stack-title">
        <SectionHeading id="stack-title" kicker="02 · Toolbox" title="Programming knowledge" />
        <ul class="stack">
            <SkillCategoryItem v-for="category in skillCategories" :key="category.id" :category="category" />
        </ul>
    </section>
</template>
