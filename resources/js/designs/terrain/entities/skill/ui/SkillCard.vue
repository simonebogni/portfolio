<script setup lang="ts">
import type { SkillCategory } from '@core/entities/skill';
import { SurfaceCard, TagList } from '@designs/terrain/shared/ui';
import { computed } from 'vue';
import { skillNames } from '../model/names';

/** A skill category and all its skills as chips. A list item. */
const props = defineProps<{
    category: SkillCategory;
}>();

const skills = computed(() => skillNames(props.category));
</script>

<template>
    <SurfaceCard as="li" class="skill-card">
        <h3 class="card__title">{{ category.name }}</h3>
        <TagList :tags="skills" :label="`${category.name} skills`" />
    </SurfaceCard>
</template>
