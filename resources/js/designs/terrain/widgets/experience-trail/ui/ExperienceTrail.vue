<script setup lang="ts">
import { shortYear, formatPeriod } from '@core/shared/lib';
import { type CurrentRoleStop, type TrailPosition, TrailStop } from '@designs/terrain/entities/work';
import { SectionHeading, TagList } from '@designs/terrain/shared/ui';

/** "Where I’ve worked": the current role, then every position, newest first, on a trail of pins. */
defineProps<{
    positions: TrailPosition[];
    currentRole: CurrentRoleStop | null;
}>();
</script>

<template>
    <section class="page-section" aria-labelledby="work-title">
        <SectionHeading id="work-title" eyebrow="Work" title="Where I’ve worked" />
        <ol class="trail plain-list">
            <TrailStop
                v-if="currentRole"
                marker="Now"
                ghost
                :title="currentRole.title"
                :when="currentRole.when"
                :org="currentRole.org"
            >
                <p v-if="currentRole.summary">{{ currentRole.summary }}</p>
            </TrailStop>
            <TrailStop
                v-for="position in positions"
                :key="position.id"
                :marker="position.current ? 'Now' : shortYear(position.startDate)"
                :ghost="position.current"
                :title="position.title"
                :when="formatPeriod(position)"
                :org="position.org"
            >
                <div v-if="position.descriptionHtml" class="prose" v-html="position.descriptionHtml"></div>
                <TagList v-if="position.tags.length" class="trail__tags" :tags="position.tags" label="Skills and technologies" :limit="8" />
            </TrailStop>
        </ol>
    </section>
</template>
