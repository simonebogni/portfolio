<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import FeaturedEngagement from '../components/FeaturedEngagement.vue';
import FilterGroup from '../components/FilterGroup.vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import WorkRow from '../components/WorkRow.vue';
import { useProfile } from '../composables/useProfile';

const props = defineProps({
    categories: { type: Array, required: true },
});

const ALL = 'all';
const { profile, fill } = useProfile();
const active = ref(ALL);

const options = computed(() => [{ value: ALL, label: 'All work' }, ...props.categories.map((category) => ({ value: category.id, label: category.title }))]);

const visibleItems = computed(() =>
    props.categories
        .filter((category) => active.value === ALL || category.id === active.value)
        .flatMap((category) => category.items.map((item) => ({ item, category: category.title }))),
);

const activeCategory = computed(() => props.categories.find((category) => category.id === active.value));
const countLabel = computed(() => `${visibleItems.value.length} ${visibleItems.value.length === 1 ? 'project' : 'projects'}`);
const status = computed(() => `Showing ${countLabel.value}${activeCategory.value ? ` in ${activeCategory.value.title}` : ''}.`);

const featured = computed(() => {
    const engagement = profile.value.featured_engagement ?? {};

    if (!engagement.title) {
        return null;
    }

    const role = profile.value.current_role ?? {};

    return {
        title: fill(engagement.title),
        summary: fill(engagement.summary),
        href: engagement.url ?? '',
        facts: [
            { term: 'My role', detail: role.title },
            { term: 'Team', detail: role.team_size ? `${role.team_size} developers` : '' },
            { term: 'Partners', detail: profile.value.copy?.works_with },
            { term: 'Outcome', detail: fill(engagement.outcome), placeholder: /\[[^\]]+\]/.test(engagement.outcome ?? '') },
        ].filter((fact) => fact.detail),
    };
});
</script>

<template>
    <div class="page page-portfolio wrap">
        <Head title="Portfolio" />
        <PageHeader eyebrow="Selected work" title="Products built with people, not just code." :lede="fill(profile.copy?.portfolio_intro)" layout="split" />

        <FilterGroup v-model="active" :options="options" label="Filter work by category" controls="work-list" />
        <p class="visually-hidden" role="status" aria-live="polite">{{ status }}</p>

        <FeaturedEngagement
            v-if="featured && active === ALL"
            id="featured-title"
            eyebrow="Featured engagement · Current role"
            :title="featured.title"
            :summary="featured.summary"
            :facts="featured.facts"
            :href="featured.href"
        />

        <section aria-labelledby="work-title">
            <SectionHeading
                id="work-title"
                :title="activeCategory ? `${activeCategory.title}.` : featured ? 'Earlier work.' : 'All work.'"
                :kicker="countLabel"
                size="md"
            />
            <ol id="work-list" class="work-list">
                <WorkRow v-for="entry in visibleItems" :key="entry.item.id" :item="entry.item" :category="entry.category" />
            </ol>
        </section>
    </div>
</template>
