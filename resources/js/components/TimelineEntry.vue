<script setup>
import { computed } from 'vue';
import { formatMonthYear } from '../lib/format';

/**
 * One position on a timeline: dates, title and a slot for the description.
 * Dates are "YYYY-MM"; `period` is the fallback text when they are missing.
 */
const props = defineProps({
    title: { type: String, required: true },
    startDate: { type: String, default: null },
    endDate: { type: String, default: null },
    current: { type: Boolean, default: false },
    period: { type: String, default: null },
    headingLevel: { type: Number, default: 4 },
});

const start = computed(() => formatMonthYear(props.startDate));
const end = computed(() => formatMonthYear(props.endDate));
</script>

<template>
    <li class="timeline-entry">
        <span class="when">
            <template v-if="start">
                <time :datetime="startDate">{{ start }}</time> –
                <template v-if="current">present</template>
                <time v-else-if="end" :datetime="endDate">{{ end }}</time>
            </template>
            <template v-else>{{ period }}</template>
        </span>
        <component :is="`h${headingLevel}`" class="timeline-entry__title">{{ title }}</component>
        <slot />
    </li>
</template>
