<script setup lang="ts">
import type { Award } from '@core/entities/award';
import type { Program } from '@core/entities/education';
import { AwardCard } from '@designs/terrain/entities/award';
import { DegreeCard } from '@designs/terrain/entities/education';
import { SectionHeading } from '@designs/terrain/shared/ui';

/** "Education and awards": degrees, then awards, as milestone cards. */
defineProps<{
    degrees: Program[];
    awards: Award[];
}>();
</script>

<template>
    <section class="page-section" aria-labelledby="education-title">
        <SectionHeading id="education-title" eyebrow="Learning & recognition" title="Education and awards" />
        <div class="grid grid--2">
            <DegreeCard v-for="degree in degrees" :key="`degree-${degree.id}`" :degree="degree" />
            <AwardCard v-for="award in awards" :key="`award-${award.id}`" :award="award" />
        </div>
    </section>
</template>
