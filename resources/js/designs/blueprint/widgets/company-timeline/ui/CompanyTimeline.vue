<script setup lang="ts">
import type { Company } from '@core/entities/work';
import { PositionEntry } from '@designs/blueprint/entities/work';
import { SectionHeading } from '@designs/blueprint/shared/ui';

/** One earlier employer: a numbered section heading and the timeline of its roles. */
defineProps<{
    company: Company;
    /** Section number, e.g. "02". */
    number: string;
}>();
</script>

<template>
    <section class="section" :aria-labelledby="`company-${company.id}`">
        <SectionHeading
            :id="`company-${company.id}`"
            :kicker="`${number} · Earlier`"
            :title="`${company.name} · ${company.city}, ${company.country}`"
        />
        <ol class="timeline">
            <PositionEntry v-for="position in company.positions" :key="position.id" :position="position" />
        </ol>
    </section>
</template>
