<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import BentoGrid from '../components/BentoGrid.vue';
import BentoTile from '../components/BentoTile.vue';
import Icon from '../components/Icon.vue';
import PageIntro from '../components/PageIntro.vue';
import TileHeading from '../components/TileHeading.vue';
import TileLabel from '../components/TileLabel.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import { useProfile } from '../composables/useProfile';
import { findOrdinal, formatPeriod, formatYear } from '../lib/format';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const { profile } = useProfile();

/** The current role from the profile config, shown first when the database has no current position. */
const currentRole = computed(() => {
    const role = profile.value.current_role ?? {};
    const hasCurrent = props.companies.some((company) => company.positions.some((position) => position.current));

    if (!role.title || hasCurrent) {
        return null;
    }

    return {
        title: role.title,
        period: role.since ? `${role.since} – present` : '',
        organisation: [role.company, profile.value.location].filter(Boolean).join(' · '),
    };
});

/** Every position, newest first, with its company. */
const positions = computed(() =>
    props.companies
        .flatMap((company) =>
            company.positions.map((position) => ({
                ...position,
                organisation: [company.name, [company.city, company.country].filter(Boolean).join(', ')].filter(Boolean).join(' · '),
            })),
        )
        .sort((a, b) => String(b.startDate ?? '').localeCompare(String(a.startDate ?? ''))),
);

const certificateIssuers = computed(() => [...new Set(props.certificates.map((certificate) => certificate.issuedBy).filter(Boolean))]);

function scoreLabel(course) {
    if (course.score === null || course.score === undefined) {
        return '';
    }

    return `${course.score}/${course.scoreMax}${course.cumLaude ? ' cum laude' : ''}`;
}
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

            <BentoTile v-if="positions.length || currentRole" :span="8" class="work" aria-labelledby="work-title">
                <TileHeading id="work-title">Work</TileHeading>
                <ol class="entries">
                    <TimelineEntry
                        v-if="currentRole"
                        :title="currentRole.title"
                        :period="currentRole.period"
                        :organisation="currentRole.organisation"
                        current
                    />
                    <TimelineEntry
                        v-for="position in positions"
                        :key="position.id"
                        :title="position.title"
                        :period="formatPeriod(position)"
                        :organisation="position.organisation"
                        :html="position.descriptionHtml"
                        :tags="position.tags"
                        :current="position.current"
                    />
                </ol>
            </BentoTile>

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
                    <TileLabel as="h2" id="courses-title">Online programmes</TileLabel>
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
