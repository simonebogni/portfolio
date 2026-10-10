<script setup lang="ts">
import { useProfile } from '@core/entities/profile';
import { formatMonthYear, formatYear, lastYearIn, pad2, placeIn } from '@core/shared/lib';
import type { KineticProfile } from '@designs/kinetic/entities/profile';
import { PageHeader, SectionHeading, SmartLink, TagList } from '@designs/kinetic/shared/ui';
import { WorkTimeline } from '@designs/kinetic/widgets/work-timeline';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { degreesOf, issuersOf, learningPlace } from '../model/education';
import type { ExperienceProps } from '../model/types';

const props = defineProps<ExperienceProps>();

const { profile } = useProfile<KineticProfile>();
const currentRole = computed(() => (profile.value.current_role?.company ? profile.value.current_role : null));

/** Degrees and awards share the "duo" panels; each gets a big figure. */
const programs = computed(() => degreesOf(props.institutes));

const issuers = computed(() => issuersOf(props.certificates));
</script>

<template>
    <div class="page page--experience container">
        <Head title="Experience" />
        <PageHeader title="Experi" accent="ence." :intro="profile.intros?.experience" />

        <WorkTimeline :companies="companies" :current-role="currentRole" :location="profile.location" />

        <section v-if="programs.length || awards.length" class="section" aria-labelledby="education-title">
            <SectionHeading id="education-title" title="Education" :kicker="awards.length ? '& awards' : ''" />
            <div class="duo">
                <article v-for="program in programs" :key="`program-${program.id}`" class="duo__panel">
                    <p class="duo__figure display" aria-hidden="true">{{ lastYearIn(program.period) || '—' }}</p>
                    <h3 class="duo__title display">{{ program.name }}</h3>
                    <p>{{ program.institute }}<template v-if="program.period"> · {{ program.period }}</template></p>
                </article>
                <article v-for="award in awards" :key="`award-${award.id}`" class="duo__panel duo__panel--accent">
                    <p class="duo__figure display" aria-hidden="true">{{ placeIn(award.title) || formatYear(award.issueDate) || '★' }}</p>
                    <h3 class="duo__title display">{{ award.title }}</h3>
                    <p>
                        <template v-if="award.subtitle">{{ award.subtitle }}</template>
                        <template v-if="award.issueDate"> · {{ formatMonthYear(award.issueDate) }}</template>
                    </p>
                    <p v-if="award.description" class="duo__text">{{ award.description }}</p>
                </article>
            </div>

            <template v-if="otherPrograms.length">
                <h3 class="subheading label">Courses and online programmes</h3>
                <ul class="course-rows plain-list">
                    <li v-for="program in otherPrograms" :key="program.id" class="course-rows__item">
                        <h4 class="course-rows__name">{{ program.name }}</h4>
                        <p v-if="learningPlace(program)" class="course-rows__place label text-accent">{{ learningPlace(program) }}</p>
                        <TagList :tags="program.tags" />
                    </li>
                </ul>
            </template>
        </section>

        <section v-if="certificates.length" class="section" aria-labelledby="certificates-title">
            <SectionHeading id="certificates-title" title="Certified" :kicker="issuers" />
            <ol class="cert-rows plain-list">
                <li v-for="(certificate, index) in certificates" :key="certificate.id" class="cert-rows__item">
                    <span class="cert-rows__index display" aria-hidden="true">{{ pad2(index + 1) }}</span>
                    <div>
                        <h3 class="cert-rows__title">{{ certificate.title }}</h3>
                        <p class="cert-rows__meta">{{ certificate.issuedBy }}<template v-if="certificate.issueDate"> · {{ formatMonthYear(certificate.issueDate) }}</template></p>
                    </div>
                    <SmartLink v-if="certificate.url" :href="certificate.url" class="cert-rows__link">
                        View<span class="visually-hidden"> {{ certificate.title }} certificate</span>
                    </SmartLink>
                </li>
            </ol>
        </section>
    </div>
</template>
