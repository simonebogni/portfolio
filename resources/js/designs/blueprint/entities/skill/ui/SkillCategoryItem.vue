<script setup lang="ts">
import type { SkillCategory } from '@core/entities/skill';
import { skillLine } from '../model/skillLine';

/** One cell of the toolbox grid: the category name and its skills on one line. */
defineProps<{
    category: SkillCategory;
}>();
</script>

<template>
    <li class="stack__item">
        <h3 class="kicker">{{ category.name }}</h3>
        <p>{{ skillLine(category) }}</p>
    </li>
</template>
