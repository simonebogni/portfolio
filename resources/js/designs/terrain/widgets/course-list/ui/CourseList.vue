<script setup lang="ts">
import type { Program } from '@core/entities/education';
import { CourseCard } from '@designs/terrain/entities/education';
import { SectionHeading } from '@designs/terrain/shared/ui';

/** "Courses": programs outside a degree. */
defineProps<{
    programs: Program[];
}>();
</script>

<template>
    <section class="page-section" aria-labelledby="courses-title">
        <SectionHeading id="courses-title" eyebrow="Always learning" title="Courses" />
        <ul class="grid grid--3 plain-list">
            <CourseCard v-for="program in programs" :key="program.id" :program="program" />
        </ul>
    </section>
</template>
