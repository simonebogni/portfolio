<script setup lang="ts">
import type { SkillCategory } from '@core/entities/skill';
import { BaseCard, ChipList } from '@designs/source/shared/ui';
import { skillCount } from '../model/count';

/** One category of programming knowledge: its subcategories, each with its skills as chips. */
defineProps<{ category: SkillCategory }>();
</script>

<template>
    <BaseCard as="li" class="skill-card">
        <h3 class="skill-card__title">{{ category.name }}</h3>
        <p class="skill-card__count">{{ skillCount(category) }} skills</p>
        <dl class="skill-card__groups">
            <div v-for="subcategory in category.subcategories" :key="subcategory.id" class="skill-card__group">
                <dt>{{ subcategory.name }}</dt>
                <dd><ChipList :items="subcategory.skills.map((skill) => skill.name)" :label="`${category.name}: ${subcategory.name}`" /></dd>
            </div>
        </dl>
    </BaseCard>
</template>
