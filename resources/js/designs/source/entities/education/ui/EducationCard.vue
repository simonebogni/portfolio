<script setup lang="ts">
import type { Program } from '@core/entities/education';
import { BaseCard } from '@designs/source/shared/ui';
import { courseScore } from '../model/score';

/** A programme at an institute, with its courses and grades in a disclosure. */
defineProps<{ program: Program; institute: string }>();
</script>

<template>
    <BaseCard as="article" class="education">
        <span class="when">{{ program.period }}</span>
        <h3 class="card-title">{{ program.name }}</h3>
        <p class="card-text">{{ institute }}</p>
        <details v-if="program.courses.length" class="courses">
            <summary>Courses and grades <span class="courses__count">({{ program.courses.length }})</span></summary>
            <ul class="courses__list bare-list">
                <li v-for="course in program.courses" :key="course.id">
                    <span>{{ course.name }}</span>
                    <span class="courses__score">{{ courseScore(course) }}</span>
                </li>
            </ul>
        </details>
    </BaseCard>
</template>
