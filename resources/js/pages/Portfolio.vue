<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import FeaturedProject from '../components/FeaturedProject.vue';
import PageHeader from '../components/PageHeader.vue';
import PortfolioFilter from '../components/PortfolioFilter.vue';
import ProjectCard from '../components/ProjectCard.vue';
import SectionHeading from '../components/SectionHeading.vue';
import { pluralize } from '../lib/format';

const props = defineProps({
    categories: { type: Array, required: true },
});

const ALL = 'all';
const selected = ref(ALL);

const total = computed(() => props.categories.reduce((sum, category) => sum + category.items.length, 0));

const options = computed(() => [
    { value: ALL, label: 'All projects', count: total.value },
    ...props.categories.map((category) => ({ value: String(category.id), label: category.title, count: category.items.length })),
]);

const visibleCategories = computed(() =>
    selected.value === ALL ? props.categories : props.categories.filter((category) => String(category.id) === selected.value),
);

/** The top item of the first category leads the unfiltered view. */
const featured = computed(() => (selected.value === ALL ? (props.categories[0]?.items[0] ?? null) : null));

const status = computed(() => {
    const count = visibleCategories.value.reduce((sum, category) => sum + category.items.length, 0);
    const scope = selected.value === ALL ? 'in all categories' : `in ${visibleCategories.value[0]?.title ?? 'this category'}`;

    return `Showing ${pluralize(count, 'project')} ${scope}.`;
});
</script>

<template>
    <div class="page page-portfolio">
        <Head title="Portfolio" />
        <PageHeader
            eyebrow="Things I’ve grown"
            title="Portfolio"
            intro="Projects I’ve built, grouped by kind. Pick a category to narrow the list."
        />

        <template v-if="categories.length">
            <PortfolioFilter v-model="selected" :options="options" label="Filter projects by category" />
            <p class="visually-hidden" role="status" aria-live="polite">{{ status }}</p>

            <FeaturedProject v-if="featured" :item="featured" :eyebrow="`Featured · ${categories[0].title}`" />

            <section
                v-for="category in visibleCategories"
                :key="category.id"
                class="page-section page-section--tight"
                :aria-labelledby="`category-${category.id}`"
            >
                <SectionHeading
                    :id="`category-${category.id}`"
                    :title="category.title"
                    :meta="pluralize(category.items.length, 'project')"
                    variant="inline"
                />
                <ul class="grid grid--3 plain-list">
                    <li v-for="item in category.items" :key="item.id">
                        <ProjectCard :item="item" />
                    </li>
                </ul>
            </section>
        </template>
        <p v-else class="empty-state">No projects to show yet.</p>
    </div>
</template>
