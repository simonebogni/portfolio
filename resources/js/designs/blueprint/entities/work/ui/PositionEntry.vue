<script setup lang="ts">
import type { WorkPosition } from '@core/entities/work';
import { formatPeriod } from '@core/shared/lib';
import { ChipList } from '@designs/blueprint/shared/ui';

/** One role on the experience timeline: period, title, description and technologies. Render inside <ol class="timeline">. */
withDefaults(
    defineProps<{
        position: WorkPosition;
        level?: number;
    }>(),
    { level: 3 },
);
</script>

<template>
    <li class="timeline__entry">
        <span class="when">{{ formatPeriod(position) }}</span>
        <component :is="`h${level}`" class="timeline__title">{{ position.title }}</component>
        <!-- Rich text written by the site owner in the admin panel. -->
        <div class="prose" v-html="position.descriptionHtml"></div>
        <ChipList :items="position.tags" label="Technologies" />
    </li>
</template>
