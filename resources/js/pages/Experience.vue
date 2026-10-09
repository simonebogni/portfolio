<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import BpIcon from '../components/BpIcon.vue';
import ChipList from '../components/ChipList.vue';
import DraftText from '../components/DraftText.vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import SpecList from '../components/SpecList.vue';
import TimelineEntry from '../components/TimelineEntry.vue';
import { useProfile } from '../composables/useProfile';
import { formatMonthYear, formatPeriod, formatYear } from '../lib/format';
import { isPlaceholder } from '../lib/profile';

const props = defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});

const { profile, teamSize, fill } = useProfile();
const role = computed(() => profile.value.current_role);

const firstYear = computed(() => {
    const years = props.companies
        .flatMap((company) => company.positions.map((position) => Number(formatYear(position.startDate))))
        .filter((year) => year > 0);

    return years.length ? Math.min(...years) : null;
});

const tag = computed(() => {
    if (!firstYear.value) {
        return 'Experience';
    }

    return `Experience · ${firstYear.value} – ${role.value.title ? 'present' : ''}`.trim();
});

const roleSince = computed(() => {
    const since = role.value.since;

    if (!since || isPlaceholder(since)) {
        return since;
    }

    return formatMonthYear(since) || since;
});

const roleScope = computed(() => [
    { label: 'Team', value: teamSize.value > 0 ? `${teamSize.value} developers` : null },
    { label: 'Partners', value: role.value.partners },
    { label: 'Focus', value: role.value.focus },
    { label: 'Hands-on', value: role.value.hands_on },
]);

/** Section numbers: 01 is the current role when there is one. */
const offset = computed(() => (role.value.title ? 1 : 0));

function number(index) {
    return String(index + 1 + offset.value).padStart(2, '0');
}

const hasFoundations = computed(
    () => props.institutes.length || props.otherPrograms.length || props.awards.length || props.certificates.length,
);
</script>

<template>
    <div class="page page--experience">
        <Head title="Experience" />
        <PageHeader :tag="tag" title="From writing the code to leading the team that writes it." :intro="fill(profile.page_intros.experience)" />

        <div class="container">
            <section v-if="role.title" class="section" aria-labelledby="now-title">
                <SectionHeading id="now-title" kicker="01 · Current role" title="Leading engineering" />
                <article class="current-role">
                    <div class="current-role__main">
                        <span v-if="roleSince" class="when"><DraftText :text="roleSince" /> – present</span>
                        <h3 class="current-role__title">{{ role.title }}</h3>
                        <p class="current-role__org">
                            <template v-if="role.company"><DraftText :text="role.company" /> · </template>{{ profile.location }}
                        </p>
                        <p v-if="role.summary">{{ fill(role.summary) }}</p>
                        <DraftText v-for="outcome in role.outcomes" :key="outcome" as="p" :text="fill(outcome)" />
                    </div>
                    <div class="current-role__scope">
                        <h4 class="visually-hidden">Role scope</h4>
                        <SpecList :items="roleScope" variant="block" />
                    </div>
                </article>
            </section>

            <section
                v-for="(company, index) in companies"
                :key="company.id"
                class="section"
                :aria-labelledby="`company-${company.id}`"
            >
                <SectionHeading
                    :id="`company-${company.id}`"
                    :kicker="`${number(index)} · Earlier`"
                    :title="`${company.name} · ${company.city}, ${company.country}`"
                />
                <ol class="timeline">
                    <TimelineEntry
                        v-for="position in company.positions"
                        :key="position.id"
                        :when="formatPeriod(position)"
                        :title="position.title"
                    >
                        <!-- Rich text written by the site owner in the admin panel. -->
                        <div class="prose" v-html="position.descriptionHtml" />
                        <ChipList :items="position.tags" label="Technologies" />
                    </TimelineEntry>
                </ol>
            </section>

            <section v-if="hasFoundations" class="section" aria-labelledby="edu-title">
                <SectionHeading
                    id="edu-title"
                    :kicker="`${number(companies.length)} · Foundations`"
                    title="Education, awards & certifications"
                />
                <div class="card-grid card-grid--3">
                    <article v-if="institutes.length || otherPrograms.length" class="card">
                        <span class="kicker">Education</span>
                        <template v-for="institute in institutes" :key="institute.id">
                            <div v-for="program in institute.programs" :key="program.id" class="card__block">
                                <h3 class="card__title">{{ program.name }}</h3>
                                <p class="card__text">{{ institute.name }}<template v-if="program.period"> · {{ program.period }}</template></p>
                            </div>
                        </template>
                        <template v-if="otherPrograms.length">
                            <h3 class="card__subtitle">Online courses</h3>
                            <ul class="line-list">
                                <li v-for="program in otherPrograms" :key="program.id">
                                    <span>{{ program.name }}</span>
                                    <span class="line-list__meta">{{ program.onlinePlatform || program.institute }}</span>
                                </li>
                            </ul>
                        </template>
                    </article>
                    <article v-for="award in awards" :key="award.id" class="card">
                        <p v-if="award.issueDate" class="card__big">{{ formatYear(award.issueDate) }}</p>
                        <h3 class="card__title">{{ award.title }}</h3>
                        <p v-if="award.subtitle" class="card__text">{{ award.subtitle }}</p>
                        <p v-if="award.description" class="card__text">{{ award.description }}</p>
                    </article>
                    <article v-if="certificates.length" class="card">
                        <span class="kicker">Certifications</span>
                        <h3 class="card__title">{{ certificates.length }} certificates</h3>
                        <ul class="line-list">
                            <li v-for="certificate in certificates" :key="certificate.id">
                                <span>
                                    {{ certificate.title }}
                                    <span class="line-list__meta">{{ certificate.issuedBy }}<template v-if="certificate.issueDate"> · {{ formatYear(certificate.issueDate) }}</template></span>
                                </span>
                                <a
                                    v-if="certificate.url"
                                    class="line-list__link"
                                    :href="certificate.url"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    View<span class="visually-hidden"> {{ certificate.title }} certificate (opens in a new tab)</span>
                                    <BpIcon name="external" :size="16" />
                                </a>
                            </li>
                        </ul>
                    </article>
                </div>
            </section>
        </div>
    </div>
</template>
