<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import MetaList from '../components/MetaList.vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import { pageKicker } from '../composables/useNavigation';
import { formatMonthYear, formatPeriod, formatRange, formatYear, lastYear } from '../lib/format';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
const currentRole = computed(() => (profile.value.current_role?.company ? profile.value.current_role : null));

const positions = computed(() =>
    props.companies.flatMap((company) =>
        company.positions.map((position) => ({
            ...position,
            org: [company.name, [company.city, company.country].filter(Boolean).join(', ')].filter(Boolean).join(' · '),
        })),
    ),
);

const programs = computed(() =>
    props.institutes.flatMap((institute) =>
        institute.programs.map((program) => ({ ...program, org: institute.name })),
    ),
);

const platforms = computed(() => [
    ...new Set(props.otherPrograms.map((program) => program.onlinePlatform || program.institute).filter(Boolean)),
]);

// Section numerals follow the sections that are actually shown.
const sections = computed(() => {
    const shown = [
        ['work', positions.value.length > 0 || currentRole.value !== null],
        ['education', programs.value.length > 0 || props.otherPrograms.length > 0],
        ['certificates', props.certificates.length > 0],
        ['awards', props.awards.length > 0],
    ].filter(([, visible]) => visible);

    return Object.fromEntries(shown.map(([key], index) => [key, ['i', 'ii', 'iii', 'iv'][index]]));
});
</script>

<template>
    <div class="page page--experience">
        <Head title="Experience" />
        <PageHeader :kicker="pageKicker('Experience')" :lede="profile.intros?.experience">
            Work &amp; <em class="accent-em">learning</em>.
        </PageHeader>

        <section v-if="sections.work" class="section" aria-labelledby="work-title">
            <SectionHeading id="work-title" :numeral="sections.work" title="Work" />
            <TimelineEntry
                v-if="currentRole"
                marker="Now"
                :when="currentRole.since ? `${currentRole.since} – present` : 'Present'"
                :title="currentRole.title"
                :org="[currentRole.company, profile.location].filter(Boolean).join(' · ')"
            >
                <p v-if="currentRole.summary" class="entry__text">{{ currentRole.summary }}</p>
            </TimelineEntry>
            <TimelineEntry
                v-for="position in positions"
                :key="position.id"
                :marker="position.current ? 'Now' : formatYear(position.startDate)"
                :when="formatPeriod(position)"
                :title="position.title"
                :org="position.org"
            >
                <!-- Rich text written by the site owner in the admin panel. -->
                <div v-if="position.descriptionHtml" class="prose" v-html="position.descriptionHtml" />
                <MetaList class="entry__tags" :items="position.tags" label="Technologies" />
            </TimelineEntry>
        </section>

        <section v-if="sections.education" class="section" aria-labelledby="education-title">
            <SectionHeading id="education-title" :numeral="sections.education" title="Education" />
            <TimelineEntry
                v-for="program in programs"
                :key="program.id"
                :marker="program.current ? 'Now' : lastYear(program.period)"
                :when="formatRange(program.period)"
                :title="program.name"
                :org="program.org"
            >
                <p v-if="program.description" class="entry__text">{{ program.description }}</p>
            </TimelineEntry>
            <TimelineEntry v-if="otherPrograms.length" marker="Online" :when="platforms.join(' · ')" title="Continuous learning">
                <ul class="course-list">
                    <li v-for="program in otherPrograms" :key="program.id">
                        <span class="course-list__name">{{ program.name }}</span>
                        <span v-if="program.description" class="course-list__text">{{ program.description }}</span>
                    </li>
                </ul>
            </TimelineEntry>
        </section>

        <section v-if="sections.certificates" class="section" aria-labelledby="certificates-title">
            <SectionHeading id="certificates-title" :numeral="sections.certificates" title="Certifications" />
            <ul class="record-list">
                <li v-for="certificate in certificates" :key="certificate.id" class="record-list__row">
                    <h3 class="record-list__title">{{ certificate.title }}</h3>
                    <p class="record-list__meta">
                        {{ [certificate.issuedBy, formatMonthYear(certificate.issueDate)].filter(Boolean).join(' · ') }}
                    </p>
                    <a v-if="certificate.url" class="record-list__link" :href="certificate.url" rel="noopener">
                        Certificate<span class="visually-hidden"> for {{ certificate.title }}</span>
                    </a>
                </li>
            </ul>
        </section>

        <section v-if="sections.awards" class="section" aria-labelledby="awards-title">
            <SectionHeading id="awards-title" :numeral="sections.awards" title="Awards" />
            <TimelineEntry
                v-for="award in awards"
                :key="award.id"
                :marker="formatYear(award.issueDate)"
                :when="formatMonthYear(award.issueDate)"
                :title="award.title"
                :org="award.subtitle"
            >
                <p v-if="award.description" class="entry__text">{{ award.description }}</p>
            </TimelineEntry>
        </section>
    </div>
</template>
