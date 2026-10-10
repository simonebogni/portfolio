<script setup lang="ts">
import { findOrdinal, formatYear } from '@core/shared/lib';
import { useProfile } from '@designs/bento/entities/profile';
import { BentoGrid, BentoTile, Icon, PageIntro, TileHeading, TileLabel } from '@designs/bento/shared/ui';
import { WorkHistory } from '@designs/bento/widgets/work-history';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { certificateIssuers as issuersOf, scoreLabel } from '../model/experience';
import type { ExperienceProps } from '../model/types';

const props = defineProps<ExperienceProps>();

const { profile } = useProfile();

const certificateIssuers = computed(() => issuersOf(props.certificates));
</script>

<template>
    <div class="page page-experience">
        <Head title="Experience" />
        <BentoGrid>
            <PageIntro
                label="Experience"
                title="Work, education and certifications"
                lead="Roles, studies, awards and certifications, newest first."
            />

            <WorkHistory :companies="companies" />

            <div class="side-stack">
                <template v-for="institute in institutes" :key="`institute-${institute.id}`">
                    <BentoTile
                        v-for="program in institute.programs"
                        :key="program.id"
                        :span="12"
                        :aria-labelledby="`program-${program.id}`"
                    >
                        <TileLabel>Education<template v-if="program.period"> · {{ program.period }}</template></TileLabel>
                        <p v-if="profile.education_score" class="figure">{{ profile.education_score }}</p>
                        <h2 :id="`program-${program.id}`" class="tile-title tile-title--sm">{{ program.name }}</h2>
                        <p class="muted">{{ institute.name }}</p>
                        <details v-if="program.courses.length" class="disclosure">
                            <summary>Courses and grades ({{ program.courses.length }})</summary>
                            <ul class="score-list">
                                <li v-for="course in program.courses" :key="course.id">
                                    <span>{{ course.name }}</span>
                                    <span class="score-list__score">{{ scoreLabel(course) }}</span>
                                </li>
                            </ul>
                        </details>
                    </BentoTile>
                </template>

                <BentoTile v-for="award in awards" :key="`award-${award.id}`" :span="12" tone="inverse" :aria-labelledby="`award-${award.id}`">
                    <TileLabel>Award<template v-if="award.issueDate"> · {{ formatYear(award.issueDate) }}</template></TileLabel>
                    <p v-if="findOrdinal(award.title)" class="figure">{{ findOrdinal(award.title) }}</p>
                    <h2 :id="`award-${award.id}`" class="tile-title tile-title--sm">{{ award.title }}</h2>
                    <p v-if="award.subtitle" class="inverse-muted">{{ award.subtitle }}</p>
                    <p v-if="award.description">{{ award.description }}</p>
                </BentoTile>

                <BentoTile v-if="otherPrograms.length" :span="12" aria-labelledby="courses-title">
                    <TileLabel id="courses-title" as="h2">Online programmes</TileLabel>
                    <ul class="stack-list">
                        <li v-for="program in otherPrograms" :key="program.id">
                            <span class="stack-list__name">{{ program.name }}</span>
                            <span v-if="program.onlinePlatform || program.institute" class="stack-list__meta">
                                {{ [program.onlinePlatform, program.institute].filter(Boolean).join(' · ') }}
                            </span>
                        </li>
                    </ul>
                </BentoTile>
            </div>

            <BentoTile v-if="certificates.length" :span="12" aria-labelledby="cert-title">
                <TileHeading id="cert-title" :meta="certificateIssuers.length === 1 ? certificateIssuers[0] : null">Certifications</TileHeading>
                <ul class="mini-grid mini-grid--5">
                    <li v-for="certificate in certificates" :key="certificate.id" class="mini-card mini-card--split">
                        <div>
                            <h3 class="mini-card__title">{{ certificate.title }}</h3>
                            <p class="mini-card__meta">
                                {{ formatYear(certificate.issueDate) }}<template v-if="certificateIssuers.length > 1"> · {{ certificate.issuedBy }}</template>
                            </p>
                        </div>
                        <a v-if="certificate.url" class="go" :href="certificate.url" target="_blank" rel="noopener noreferrer">
                            View<span class="visually-hidden"> the {{ certificate.title }} certificate (opens in a new tab)</span>
                            <Icon name="arrow-up-right" :size="18" />
                        </a>
                    </li>
                </ul>
            </BentoTile>
        </BentoGrid>
    </div>
</template>
