<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppIcon from '../components/AppIcon.vue';
import BaseCard from '../components/BaseCard.vue';
import ChipList from '../components/ChipList.vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import TextLink from '../components/TextLink.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import TimelineList from '../components/TimelineList.vue';
import { formatMonthYear, formatYear } from '../lib/format';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
const eyebrow = computed(() => `$ git log --author="${profile.value.name.trim().split(/\s+/)[0].toLowerCase()}"`);

// The current role from config/profile.php, shown only when it is filled in and not already in the database.
const currentRole = computed(() => {
    const role = profile.value.current_role;
    const listed = props.companies.some((company) => company.positions.some((position) => position.current));

    return role?.company && !listed ? role : null;
});

const issuers = computed(() => [...new Set(props.certificates.map((certificate) => certificate.issuedBy).filter(Boolean))].join(', '));

function courseScore(course) {
    return `${course.score}/${course.scoreMax}${course.cumLaude ? ' cum laude' : ''}`;
}
</script>

<template>
    <div class="page page-experience">
        <Head title="Experience" />
        <PageHeader :eyebrow="eyebrow" title="Experience" :intro="profile.intros?.experience" />

        <section class="block" aria-labelledby="work-title">
            <SectionHeading id="work-title" title="Work" comment="most recent first" />

            <BaseCard v-if="currentRole" as="article" padding="lg" class="company" aria-labelledby="current-role-title">
                <div class="company__head">
                    <h3 id="current-role-title" class="company__name">{{ currentRole.company }}</h3>
                    <span v-if="profile.location" class="company__where">{{ profile.location }}</span>
                </div>
                <TimelineList>
                    <TimelineEntry :title="currentRole.title" :start-date="currentRole.since" current :period="currentRole.since ? null : 'Current role'">
                        <p v-if="currentRole.team_size" class="timeline-entry__body">Leading a team of {{ currentRole.team_size }}.</p>
                    </TimelineEntry>
                </TimelineList>
            </BaseCard>

            <BaseCard v-for="company in companies" :key="company.id" as="article" padding="lg" class="company" :aria-labelledby="`company-${company.id}`">
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
                        <div v-if="position.descriptionHtml" class="prose timeline-entry__body" v-html="position.descriptionHtml" />
                        <ChipList :items="position.tags" />
                    </TimelineEntry>
                </TimelineList>
            </BaseCard>
        </section>

        <section v-if="institutes.length || otherPrograms.length" class="block" aria-labelledby="education-title">
            <SectionHeading id="education-title" title="Education" comment="formal + self-taught" />
            <div class="card-grid card-grid--2">
                <template v-for="institute in institutes" :key="institute.id">
                    <BaseCard v-for="program in institute.programs" :key="program.id" as="article" class="education">
                        <span class="when">{{ program.period }}</span>
                        <h3 class="card-title">{{ program.name }}</h3>
                        <p class="card-text">{{ institute.name }}</p>
                        <details v-if="program.courses.length" class="courses">
                            <summary>Courses and grades <span class="courses__count">({{ program.courses.length }})</span></summary>
                            <ul class="courses__list bare-list">
                                <li v-for="course in program.courses" :key="course.id">
                                    <span>{{ course.name }}</span>
                                    <span class="courses__score">{{ courseScore(course) }}</span>
                                </li>
                            </ul>
                        </details>
                    </BaseCard>
                </template>
                <BaseCard v-if="otherPrograms.length" as="article" class="education">
                    <span class="when">Online programmes</span>
                    <h3 class="card-title">Continuous learning</h3>
                    <ul class="programs bare-list">
                        <li v-for="program in otherPrograms" :key="program.id">
                            {{ program.name }}
                            <span v-if="program.onlinePlatform || program.institute" class="programs__where">
                                · {{ [program.institute, program.onlinePlatform].filter(Boolean).join(', ') }}
                            </span>
                        </li>
                    </ul>
                </BaseCard>
            </div>
        </section>

        <section v-if="certificates.length" class="block" aria-labelledby="certificates-title">
            <SectionHeading id="certificates-title" title="Certifications" :comment="issuers || null" />
            <ul class="card-grid card-grid--3 bare-list">
                <BaseCard v-for="certificate in certificates" :key="certificate.id" as="li" class="certificate">
                    <div>
                        <span v-if="certificate.issueDate" class="when">
                            <time :datetime="certificate.issueDate">{{ formatMonthYear(certificate.issueDate) }}</time>
                        </span>
                        <h3 class="card-title">{{ certificate.title }}</h3>
                        <p v-if="certificate.description" class="card-text card-text--small">{{ certificate.description }}</p>
                    </div>
                    <TextLink v-if="certificate.url" :href="certificate.url" :context="certificate.title">View certificate</TextLink>
                </BaseCard>
            </ul>
        </section>

        <section v-if="awards.length" aria-labelledby="awards-title">
            <SectionHeading id="awards-title" title="Awards" />
            <BaseCard v-for="award in awards" :key="award.id" as="article" class="award" :aria-labelledby="`award-${award.id}`">
                <div class="award__icon"><AppIcon name="trophy" :size="30" /></div>
                <div>
                    <span class="when">
                        <time v-if="award.issueDate" :datetime="award.issueDate">{{ formatYear(award.issueDate) }}</time>
                    </span>
                    <h3 :id="`award-${award.id}`" class="card-title">{{ award.title }}</h3>
                    <p v-if="award.subtitle" class="card-text">{{ award.subtitle }}</p>
                    <p v-if="award.description" class="award__description">{{ award.description }}</p>
                    <ChipList :items="award.tags" />
                </div>
            </BaseCard>
        </section>
    </div>
</template>
