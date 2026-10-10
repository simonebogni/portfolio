<script setup lang="ts">
import type { Program } from '@core/entities/education';
import { yearRange } from '@core/shared/lib';
import { SurfaceCard } from '@designs/terrain/shared/ui';

/** A degree as a milestone: its years as a big numeral, the program and the institute. */
defineProps<{
    degree: Program;
}>();
</script>

<template>
    <SurfaceCard as="article" class="milestone">
        <p v-if="yearRange(degree.period)" class="milestone__numeral">{{ yearRange(degree.period) }}</p>
        <h3 class="milestone__title">{{ degree.name }}</h3>
        <p class="milestone__text">{{ degree.institute }}<template v-if="degree.period"> · {{ degree.period }}</template></p>
        <p v-if="degree.description" class="milestone__text">{{ degree.description }}</p>
    </SurfaceCard>
</template>
