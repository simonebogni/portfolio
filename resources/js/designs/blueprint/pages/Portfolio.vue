<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import BpIcon from '../components/BpIcon.vue';
import CaseCard from '../components/CaseCard.vue';
import FilterGroup from '../components/FilterGroup.vue';
import PageHeader from '../components/PageHeader.vue';
import TextLink from '../components/TextLink.vue';
import { useProfile } from '../composables/useProfile';
import { formatYear } from '../lib/format';
import { isExternal } from '../lib/profile';

const props = defineProps({
    categories: { type: Array, required: true },
});

const { profile, teamSize, fill } = useProfile();

const LEADERSHIP = 'leadership';
const ALL = 'all';

/** The configured leadership case study (config/profile.php), or null. */
const featured = computed(() => {
    const study = profile.value.featured_case_study;

    if (!study?.title) {
        return null;
    }

    return {
        title: study.title,
        summary: fill(study.summary),
        url: study.url,
        meta: [
            { label: 'Role', value: profile.value.current_role.title },
            { label: 'Team', value: teamSize.value > 0 ? `${teamSize.value} developers` : null },
            { label: 'Partners', value: profile.value.current_role.partners },
            { label: 'Stack', value: study.stack },
            { label: 'Outcome', value: study.outcome },
        ],
    };
});

const filterOptions = computed(() => [
    { value: ALL, label: 'All' },
    ...(featured.value ? [{ value: LEADERSHIP, label: 'Leadership' }] : []),
    ...props.categories.map((category) => ({ value: String(category.id), label: category.title })),
]);

const selected = ref(ALL);

const visibleCategories = computed(() => {
    if (selected.value === ALL) {
        return props.categories;
    }

    return props.categories.filter((category) => String(category.id) === selected.value);
});

const showFeatured = computed(() => featured.value && (selected.value === ALL || selected.value === LEADERSHIP));

/**
 * With "All", the first (highest priority) category gets full case cards and the
 * rest are listed compactly under "More projects". A single category shows only cards.
 */
const cards = computed(() => {
    const categories = selected.value === ALL ? visibleCategories.value.slice(0, 1) : visibleCategories.value;

    return categories.flatMap((category) => category.items.map((item) => ({ item, category })));
});

const more = computed(() =>
    selected.value === ALL ? visibleCategories.value.slice(1).flatMap((category) => category.items.map((item) => ({ item, category }))) : [],
);

const resultCount = computed(() => cards.value.length + more.value.length + (showFeatured.value ? 1 : 0));

const resultLabel = computed(() => {
    const option = filterOptions.value.find((candidate) => candidate.value === selected.value);
    const noun = resultCount.value === 1 ? 'project' : 'projects';

    return selected.value === ALL ? `Showing all ${resultCount.value} ${noun}` : `Showing ${resultCount.value} ${noun} in ${option?.label}`;
});

function kind(item, category) {
    return [category.title, item.subtitle].filter(Boolean).join(' · ');
}

function meta(item, category) {
    return [
        { label: 'Type', value: category.title },
        { label: 'Year', value: formatYear(item.date) },
        { label: 'Stack', value: item.tags.slice(0, 6).join(' · ') },
    ];
}

function primaryUrl(item) {
    return item.liveUrl || item.gitRepoUrl;
}
</script>

<template>
    <div class="page page--portfolio">
        <Head title="Case studies" />
        <PageHeader tag="Case studies" title="The work, the team and the people behind it." :intro="fill(profile.page_intros.portfolio)">
            <FilterGroup v-model="selected" :options="filterOptions" label="Filter case studies" />
        </PageHeader>

        <div class="container">
            <p class="visually-hidden" role="status" aria-live="polite" aria-atomic="true">{{ resultLabel }}</p>

            <ol v-if="showFeatured || cards.length" class="cases">
                <CaseCard
                    v-if="showFeatured"
                    kind="Leadership · Current role"
                    :title="featured.title"
                    :summary="featured.summary"
                    :meta="featured.meta"
                    draft
                >
                    <template v-if="featured.url" #actions>
                        <TextLink :href="featured.url" :context="featured.title">Read the case study</TextLink>
                    </template>
                </CaseCard>
                <CaseCard
                    v-for="{ item, category } in cards"
                    :key="item.id"
                    :kind="kind(item, category)"
                    :title="item.title"
                    :summary="item.description"
                    :meta="meta(item, category)"
                >
                    <template v-if="item.liveUrl || item.gitRepoUrl" #actions>
                        <TextLink v-if="item.liveUrl" :href="item.liveUrl" :context="item.title">View it live</TextLink>
                        <TextLink v-if="item.gitRepoUrl" :href="item.gitRepoUrl" :context="item.title">Source code</TextLink>
                    </template>
                </CaseCard>
            </ol>

            <section v-if="more.length" class="more" aria-labelledby="more-title">
                <h2 id="more-title" class="more__title">More projects</h2>
                <ul class="link-list">
                    <li v-for="{ item, category } in more" :key="item.id">
                        <component
                            :is="primaryUrl(item) ? 'a' : 'div'"
                            class="link-list__item"
                            :href="primaryUrl(item) || undefined"
                            :target="isExternal(primaryUrl(item)) ? '_blank' : undefined"
                            :rel="isExternal(primaryUrl(item)) ? 'noopener noreferrer' : undefined"
                        >
                            <span>
                                <b>{{ item.title }}</b>
                                <span class="link-list__meta">{{ [category.title, item.tags.slice(0, 3).join(' · ')].filter(Boolean).join(' — ') }}</span>
                            </span>
                            <template v-if="primaryUrl(item)">
                                <span v-if="isExternal(primaryUrl(item))" class="visually-hidden"> (opens in a new tab)</span>
                                <BpIcon name="external" :size="18" />
                            </template>
                        </component>
                    </li>
                </ul>
            </section>

            <p v-if="!resultCount" class="empty-state">No projects in this category yet.</p>
        </div>
    </div>
</template>
