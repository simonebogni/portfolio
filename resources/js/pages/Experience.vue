<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import SurfaceCard from '../components/SurfaceCard.vue';
import TagList from '../components/TagList.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import BaseIcon from '../components/BaseIcon.vue';
import { formatMonthYear, formatPeriod, formatYear, shortYear, yearRange } from '../lib/format';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);

/** Every work position, newest first, with its company. */
const positions = computed(() =>
    props.companies
        .flatMap((company) =>
            company.positions.map((position) => ({
                ...position,
                org: [company.name, [company.city, company.country].filter(Boolean).join(', ')].filter(Boolean).join(' · '),
            })),
        )
        .sort((a, b) => String(b.startDate ?? '').localeCompare(String(a.startDate ?? ''))),
);

/** The current role from config/profile.php, shown first unless a position is already marked current. */
const currentRole = computed(() => {
    const role = profile.value.current_role;

    if (!role?.title || positions.value.some((position) => position.current)) {
        return null;
    }

    return {
        title: role.title,
        when: role.since ? `${formatMonthYear(role.since)} – present` : 'Present',
        org: [role.company, profile.value.location].filter(Boolean).join(' · '),
        summary: role.summary,
    };
});

const degrees = computed(() =>
    props.institutes.flatMap((institute) =>
        institute.programs.map((program) => ({ ...program, institute: institute.name })),
    ),
);

const certificateIssuer = computed(() => {
    const issuers = [...new Set(props.certificates.map((certificate) => certificate.issuedBy).filter(Boolean))];

    return issuers.length === 1 ? issuers[0] : 'Credentials';
});
</script>

<template>
    <div class="page page-experience">
        <Head title="Experience" />
        <PageHeader
            eyebrow="The path so far"
            title="Experience"
            intro="Where I’ve worked, what I’ve studied and the certifications I’ve earned along the way."
        />

        <section v-if="positions.length || currentRole" class="page-section" aria-labelledby="work-title">
            <SectionHeading id="work-title" eyebrow="Work" title="Where I’ve worked" />
            <ol class="trail plain-list">
                <TimelineEntry
                    v-if="currentRole"
                    marker="Now"
                    ghost
                    :title="currentRole.title"
                    :when="currentRole.when"
                    :org="currentRole.org"
                >
                    <p v-if="currentRole.summary">{{ currentRole.summary }}</p>
                </TimelineEntry>
                <TimelineEntry
                    v-for="position in positions"
                    :key="position.id"
                    :marker="position.current ? 'Now' : shortYear(position.startDate)"
                    :ghost="position.current"
                    :title="position.title"
                    :when="formatPeriod(position)"
                    :org="position.org"
                >
                    <div v-if="position.descriptionHtml" class="prose" v-html="position.descriptionHtml" />
                    <TagList v-if="position.tags.length" class="trail__tags" :tags="position.tags" label="Skills and technologies" :limit="8" />
                </TimelineEntry>
            </ol>
        </section>

        <section v-if="degrees.length || awards.length" class="page-section" aria-labelledby="education-title">
            <SectionHeading id="education-title" eyebrow="Learning & recognition" title="Education and awards" />
            <div class="grid grid--2">
                <SurfaceCard v-for="degree in degrees" :key="`degree-${degree.id}`" as="article" class="milestone">
                    <p v-if="yearRange(degree.period)" class="milestone__numeral">{{ yearRange(degree.period) }}</p>
                    <h3 class="milestone__title">{{ degree.name }}</h3>
                    <p class="milestone__text">{{ degree.institute }}<template v-if="degree.period"> · {{ degree.period }}</template></p>
                    <p v-if="degree.description" class="milestone__text">{{ degree.description }}</p>
                </SurfaceCard>
                <SurfaceCard v-for="award in awards" :key="`award-${award.id}`" as="article" class="milestone">
                    <p v-if="award.issueDate" class="milestone__numeral milestone__numeral--highlight">{{ formatYear(award.issueDate) }}</p>
                    <h3 class="milestone__title">{{ award.title }}</h3>
                    <p v-if="award.subtitle" class="milestone__text">{{ award.subtitle }}</p>
                    <p v-if="award.description" class="milestone__text">{{ award.description }}</p>
                </SurfaceCard>
            </div>
        </section>

        <section v-if="otherPrograms.length" class="page-section" aria-labelledby="courses-title">
            <SectionHeading id="courses-title" eyebrow="Always learning" title="Courses" />
            <ul class="grid grid--3 plain-list">
                <SurfaceCard v-for="program in otherPrograms" :key="program.id" as="li" shape="leaf" class="course">
                    <p class="course__provider">{{ program.onlinePlatform || program.institute }}</p>
                    <h3 class="card__title card__title--sm">{{ program.name }}</h3>
                    <p v-if="program.institute && program.onlinePlatform" class="course__meta">{{ program.institute }}</p>
                    <p v-if="program.description" class="course__text">{{ program.description }}</p>
                    <p v-if="program.current" class="status-chip">In progress</p>
                </SurfaceCard>
            </ul>
        </section>

        <section v-if="certificates.length" class="page-section" aria-labelledby="certificates-title">
            <SectionHeading id="certificates-title" :eyebrow="certificateIssuer" title="Certifications" />
            <ul class="grid grid--certs plain-list">
                <SurfaceCard v-for="certificate in certificates" :key="certificate.id" as="li" class="certificate">
                    <div>
                        <h3 class="certificate__title">{{ certificate.title }}</h3>
                        <p v-if="certificate.issueDate" class="certificate__date">{{ formatMonthYear(certificate.issueDate) }}</p>
                    </div>
                    <a v-if="certificate.url" class="text-link" :href="certificate.url" target="_blank" rel="noopener noreferrer">
                        View<span class="visually-hidden"> the {{ certificate.title }} certificate (opens in a new tab)</span>
                        <BaseIcon name="external" :size="16" />
                    </a>
                </SurfaceCard>
            </ul>
        </section>
    </div>
</template>
