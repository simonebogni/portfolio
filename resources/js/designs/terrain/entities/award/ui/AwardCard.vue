<script setup lang="ts">
import type { Award } from '@core/entities/award';
import { formatYear } from '@core/shared/lib';
import { SurfaceCard } from '@designs/terrain/shared/ui';

/** An award as a milestone, its year highlighted. */
defineProps<{
    award: Award;
}>();
</script>

<template>
    <SurfaceCard as="article" class="milestone">
        <p v-if="award.issueDate" class="milestone__numeral milestone__numeral--highlight">{{ formatYear(award.issueDate) }}</p>
        <h3 class="milestone__title">{{ award.title }}</h3>
        <p v-if="award.subtitle" class="milestone__text">{{ award.subtitle }}</p>
        <p v-if="award.description" class="milestone__text">{{ award.description }}</p>
    </SurfaceCard>
</template>
