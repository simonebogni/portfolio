<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import ChipList from '../components/ChipList.vue';
import DefinitionRows from '../components/DefinitionRows.vue';
import PageHeader from '../components/PageHeader.vue';
import RecognitionCard from '../components/RecognitionCard.vue';
import SectionHeading from '../components/SectionHeading.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import { useProfile } from '../composables/useProfile';
import { isPlaceholder } from '../lib/copy';
import { formatMonthYear, formatPeriod, formatYear } from '../lib/format';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const { profile, fill } = useProfile();
const role = computed(() => profile.value.current_role ?? {});

/** Year of the earliest position in the data: "building software since". */
const firstYear = computed(() => {
    const years = props.companies
        .flatMap((company) => company.positions.map((position) => Number(formatYear(position.startDate))))
        .filter(Boolean);

    return years.length ? Math.min(...years) : null;
});

const title = computed(() => {
    const years = firstYear.value ? new Date().getFullYear() - firstYear.value : 0;

    return years > 1 ? `${years} years of building software — and the teams behind it.` : 'Building software — and the teams behind it.';
});

const glance = computed(() =>
    [
        { term: 'Current role', detail: role.value.title },
        { term: 'Team', detail: role.value.team_size ? `${role.value.team_size} developers` : '' },
        { term: 'Works with', detail: profile.value.copy?.works_with },
        { term: 'Building software since', detail: firstYear.value ? String(firstYear.value) : '' },
        { term: 'Based in', detail: profile.value.location },
    ].filter((row) => row.detail),
);

const currentRole = computed(() => ({
    when: role.value.since ? `${formatMonthYear(role.value.since)} – present` : 'Present',
    org: [role.value.company, profile.value.location].filter(Boolean).join(' · '),
    summary: fill(role.value.summary),
    highlights: (role.value.highlights ?? []).map(fill),
    scope: (role.value.scope ?? []).map(fill),
}));

/** Every position, newest first, with its company. */
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

/** Average course score as a percentage, when the program lists graded courses. */
function averageScore(program) {
    const graded = (program.courses ?? []).filter((course) => course.score && course.scoreMax);

    if (!graded.length) {
        return '';
    }

    const average = graded.reduce((sum, course) => sum + course.score / course.scoreMax, 0) / graded.length;

    return `${Math.round(average * 100)}%`;
}

const degrees = computed(() =>
    props.institutes.flatMap((institute) =>
        institute.programs.map((program) => ({
            id: `program-${program.id}`,
            figure: averageScore(program),
            title: program.name,
            text: [averageScore(program) ? 'Average course score' : '', institute.name, program.period].filter(Boolean).join(' · '),
        })),
    ),
);

/** "Hackathon 2019 - 2nd place" → figure "2nd", title "Hackathon 2019". */
const awardCards = computed(() =>
    props.awards.map((award) => {
        const placing = award.title.match(/(\d+(?:st|nd|rd|th))\s+place/i);

        return {
            id: `award-${award.id}`,
            figure: placing ? placing[1] : formatYear(award.issueDate),
            title: placing ? award.title.replace(placing[0], '').replace(/[\s\-–—]+$/, '').trim() : award.title,
            text: [award.subtitle, award.description].filter(Boolean).join(' — '),
        };
    }),
);

const certificatesTitle = computed(() => {
    const issuers = [...new Set(props.certificates.map((certificate) => certificate.issuedBy).filter(Boolean))];

    return issuers.length === 1 ? `${issuers[0].replace(/\.org$/i, '')} certifications` : 'Certifications';
});
</script>

<template>
    <div class="page page-experience wrap">
        <Head title="Experience" />
        <PageHeader eyebrow="Experience" :title="title" :lede="fill(profile.copy?.experience_intro)" />

        <div class="experience-layout">
            <aside class="glance" aria-labelledby="glance-title">
                <h2 id="glance-title" class="glance__title">At a glance</h2>
                <DefinitionRows :items="glance" variant="stacked" />
            </aside>

            <section aria-labelledby="roles-title">
                <h2 id="roles-title" class="visually-hidden">Roles</h2>
                <ol class="timeline">
                    <TimelineEntry :when="currentRole.when" :title="role.title" :org="currentRole.org">
                        <p>{{ currentRole.summary }}</p>
                        <ul v-if="currentRole.highlights.length" class="timeline-entry__points">
                            <li v-for="highlight in currentRole.highlights" :key="highlight" :class="{ 'is-placeholder': isPlaceholder(highlight) }">
                                {{ highlight }}
                            </li>
                        </ul>
                        <template #chips>
                            <ChipList :items="currentRole.scope" label="Scope" />
                        </template>
                    </TimelineEntry>
                    <TimelineEntry v-for="position in positions" :key="position.id" :when="formatPeriod(position)" :title="position.title" :org="position.org">
                        <div class="rich-text" v-html="position.descriptionHtml" />
                        <template #chips>
                            <ChipList :items="position.tags" label="Technologies and skills" />
                        </template>
                    </TimelineEntry>
                </ol>
            </section>
        </div>

        <section class="section" aria-labelledby="education-title">
            <SectionHeading id="education-title" title="Education and recognition." kicker="Foundations" />
            <div class="recognition-grid">
                <RecognitionCard v-for="degree in degrees" :key="degree.id" :figure="degree.figure" :title="degree.title" :text="degree.text">
                    <template v-if="otherPrograms.length">
                        <h4 class="recognition-card__subtitle">Further learning</h4>
                        <ul class="plain-list">
                            <li v-for="program in otherPrograms" :key="program.id">
                                {{ program.name }}<span v-if="program.onlinePlatform || program.institute" class="muted">
                                    · {{ [program.institute, program.onlinePlatform].filter(Boolean).join(', ') }}</span>
                            </li>
                        </ul>
                    </template>
                </RecognitionCard>
                <RecognitionCard v-for="award in awardCards" :key="award.id" :figure="award.figure" :title="award.title" :text="award.text" />
                <RecognitionCard v-if="certificates.length" :title="certificatesTitle">
                    <ul class="certificate-list">
                        <li v-for="certificate in certificates" :key="certificate.id">
                            <span>{{ certificate.title }} <span class="muted">· {{ formatYear(certificate.issueDate) }}</span></span>
                            <a v-if="certificate.url" class="text-link" :href="certificate.url">
                                View<span class="visually-hidden"> {{ certificate.title }} certificate</span>
                            </a>
                        </li>
                    </ul>
                </RecognitionCard>
            </div>
        </section>
    </div>
</template>
