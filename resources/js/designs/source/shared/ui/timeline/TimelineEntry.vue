<script setup lang="ts">
import { formatMonthYear } from '@core/shared/lib';
import { computed } from 'vue';

/**
 * One position on a timeline: dates, title and a slot for the description.
 * Dates are "YYYY-MM"; `period` is the fallback text when they are missing.
 */
const props = withDefaults(
    defineProps<{
        title: string;
        startDate?: string | null;
        endDate?: string | null;
        current?: boolean;
        period?: string | null;
        headingLevel?: number;
    }>(),
    { startDate: null, endDate: null, period: null, headingLevel: 4 },
);

const start = computed(() => formatMonthYear(props.startDate));
const end = computed(() => formatMonthYear(props.endDate));
</script>

<template>
    <li class="timeline-entry">
        <span class="when">
            <template v-if="start">
                <time :datetime="startDate ?? undefined">{{ start }}</time> –
                <template v-if="current">present</template>
                <time v-else-if="end" :datetime="endDate ?? undefined">{{ end }}</time>
            </template>
            <template v-else>{{ period }}</template>
        </span>
        <component :is="`h${headingLevel}`" class="timeline-entry__title">{{ title }}</component>
        <slot></slot>
    </li>
</template>
