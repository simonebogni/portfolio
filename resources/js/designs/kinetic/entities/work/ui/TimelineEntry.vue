<script setup lang="ts">
import { TagList } from '@designs/kinetic/shared/ui';

/**
 * One role on the work timeline: a big year on the left, the title,
 * organisation, description (default slot) and tags on the right.
 * `highlight` gives the row a tinted background (used for the current role).
 */
withDefaults(
    defineProps<{
        year: string;
        period?: string;
        title: string;
        org?: string;
        tags?: readonly string[];
        highlight?: boolean;
        headingLevel?: number;
    }>(),
    { period: '', org: '', tags: () => [], highlight: false, headingLevel: 3 },
);
</script>

<template>
    <li class="timeline-entry" :class="{ 'timeline-entry--highlight': highlight }">
        <p class="timeline-entry__when">
            <span class="timeline-entry__year display">{{ year }}</span>
            <span v-if="period" class="timeline-entry__period">{{ period }}</span>
        </p>
        <div class="timeline-entry__body">
            <component :is="`h${headingLevel}`" class="timeline-entry__title display">{{ title }}</component>
            <p v-if="org" class="timeline-entry__org">{{ org }}</p>
            <div class="timeline-entry__text"><slot></slot></div>
            <TagList :tags="tags" />
        </div>
    </li>
</template>
