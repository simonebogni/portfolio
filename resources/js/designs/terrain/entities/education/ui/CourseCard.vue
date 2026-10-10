<script setup lang="ts">
import type { Program } from '@core/entities/education';
import { SurfaceCard } from '@designs/terrain/shared/ui';

/** A course or online program on a leaf card. A list item. */
defineProps<{
    program: Program;
}>();
</script>

<template>
    <SurfaceCard as="li" shape="leaf" class="course">
        <p class="course__provider">{{ program.onlinePlatform || program.institute }}</p>
        <h3 class="card__title card__title--sm">{{ program.name }}</h3>
        <p v-if="program.institute && program.onlinePlatform" class="course__meta">{{ program.institute }}</p>
        <p v-if="program.description" class="course__text">{{ program.description }}</p>
        <p v-if="program.current" class="status-chip">In progress</p>
    </SurfaceCard>
</template>
