<script setup lang="ts">
import type { Company } from '@core/entities/work';
import { BaseCard, ChipList, TimelineEntry, TimelineList } from '@designs/source/shared/ui';

/** A company with its positions on a timeline. */
defineProps<{ company: Company }>();
</script>

<template>
    <BaseCard as="article" padding="lg" class="company" :aria-labelledby="`company-${company.id}`">
        <div class="company__head">
            <h3 :id="`company-${company.id}`" class="company__name">{{ company.name }}</h3>
            <span class="company__where">{{ [company.city, company.country].filter(Boolean).join(', ') }}</span>
        </div>
        <p v-if="company.description" class="company__description">{{ company.description }}</p>
        <TimelineList :label="`Positions at ${company.name}`">
            <TimelineEntry
                v-for="position in company.positions"
                :key="position.id"
                :title="position.title"
                :start-date="position.startDate"
                :end-date="position.endDate"
                :current="position.current"
                :period="position.period"
            >
                <!-- Rich text written by the site owner in the admin panel. -->
                <div v-if="position.descriptionHtml" class="prose timeline-entry__body" v-html="position.descriptionHtml"></div>
                <ChipList :items="position.tags" />
            </TimelineEntry>
        </TimelineList>
    </BaseCard>
</template>
