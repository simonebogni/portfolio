<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import SmartLink from '../components/SmartLink.vue';
import TagList from '../components/TagList.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import { formatMonthYear, formatPeriod, formatYear, lastYearIn, pad2, placeIn } from '../lib/format';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
const currentRole = computed(() => (profile.value.current_role?.company ? profile.value.current_role : null));

/** Every position of every company, newest first. */
const positions = computed(() =>
    props.companies
        .flatMap((company) =>
            company.positions.map((position) => ({
                ...position,
                org: [company.name, company.city].filter(Boolean).join(' · '),
            })),
        )
        .sort((a, b) => String(b.startDate ?? '').localeCompare(String(a.startDate ?? ''))),
);

const workSpan = computed(() => {
    const first = positions.value.at(-1);

    if (!first) {
        return '';
    }

    const end = currentRole.value || positions.value.some((position) => position.current) ? 'now' : formatYear(positions.value[0].endDate);

    return `${formatYear(first.startDate)} — ${end}`;
});

/** Degrees and awards share the "duo" panels; each gets a big figure. */
const programs = computed(() =>
    props.institutes.flatMap((institute) =>
        institute.programs.map((program) => ({ ...program, institute: institute.name, website: institute.website })),
    ),
);

const issuers = computed(() => [...new Set(props.certificates.map((certificate) => certificate.issuedBy).filter(Boolean))].join(' · '));

const learningPlace = (program) => [program.institute, program.onlinePlatform].filter(Boolean).join(' · ');
</script>

<template>
    <div class="page page--experience container">
        <Head title="Experience" />
        <PageHeader title="Experi" accent="ence." :intro="profile.intros?.experience" />

        <section v-if="positions.length || currentRole" class="section" aria-labelledby="work-title">
            <SectionHeading id="work-title" title="Work" :kicker="workSpan" />
            <ol class="timeline plain-list">
                <TimelineEntry
                    v-if="currentRole"
                    year="Now"
                    :period="currentRole.since ? `${formatMonthYear(currentRole.since) || currentRole.since} – present` : 'Present'"
                    :title="currentRole.title"
                    :org="[currentRole.company, profile.location].filter(Boolean).join(' · ')"
                    highlight
                >
                    <p v-if="currentRole.summary">{{ currentRole.summary }}</p>
                </TimelineEntry>
                <TimelineEntry
                    v-for="position in positions"
                    :key="position.id"
                    :year="formatYear(position.startDate) || position.period"
                    :period="formatPeriod(position)"
                    :title="position.title"
                    :org="position.org"
                    :tags="position.tags"
                    :highlight="position.current && !currentRole"
                >
                    <!-- Rich text written by the site owner in the admin panel. -->
                    <div class="rich-text" v-html="position.descriptionHtml" />
                </TimelineEntry>
            </ol>
        </section>

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
