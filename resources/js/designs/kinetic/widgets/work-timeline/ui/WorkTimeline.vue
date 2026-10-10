<script setup lang="ts">
import type { CurrentRole } from '@core/entities/profile';
import type { Company } from '@core/entities/work';
import { formatMonthYear, formatPeriod, formatYear } from '@core/shared/lib';
import { TimelineEntry } from '@designs/kinetic/entities/work';
import { SectionHeading } from '@designs/kinetic/shared/ui';
import { computed } from 'vue';
import { timelinePositions, workSpan } from '../model/positions';

/**
 * The "Work" section: the current role from the profile (when a company is set) as a highlighted
 * "Now" entry, then every position, newest first.
 */
const props = defineProps<{
    companies: readonly Company[];
    currentRole: CurrentRole | null;
    location: string | null;
}>();

const positions = computed(() => timelinePositions(props.companies));
const span = computed(() => workSpan(positions.value, props.currentRole !== null));
</script>

<template>
    <section v-if="positions.length || currentRole" class="section" aria-labelledby="work-title">
        <SectionHeading id="work-title" title="Work" :kicker="span" />
        <ol class="timeline plain-list">
            <TimelineEntry
                v-if="currentRole"
                year="Now"
                :period="currentRole.since ? `${formatMonthYear(currentRole.since) || currentRole.since} – present` : 'Present'"
                :title="currentRole.title"
                :org="[currentRole.company, location].filter(Boolean).join(' · ')"
                highlight
            >
                <p v-if="currentRole.summary">{{ currentRole.summary }}</p>
            </TimelineEntry>
            <TimelineEntry
                v-for="position in positions"
                :key="position.id"
                :year="formatYear(position.startDate) || (position.period ?? '')"
                :period="formatPeriod(position)"
                :title="position.title"
                :org="position.org"
                :tags="position.tags"
                :highlight="position.current && !currentRole"
            >
                <!-- Rich text written by the site owner in the admin panel. -->
                <div class="rich-text" v-html="position.descriptionHtml"></div>
            </TimelineEntry>
        </ol>
    </section>
</template>
