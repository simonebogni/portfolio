<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import FeaturedProject from '../components/FeaturedProject.vue';
import FilterBar from '../components/FilterBar.vue';
import PageHeader from '../components/PageHeader.vue';
import ProjectRow from '../components/ProjectRow.vue';
import { pageKicker } from '../composables/useNavigation';

const props = defineProps({
    categories: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
const ALL = 'all';
const selected = ref(ALL);

const total = computed(() => props.categories.reduce((sum, category) => sum + category.items.length, 0));

// Projects keep the same number whatever the filter.
const numbers = computed(() => {
    const map = new Map();
    let next = 1;

    for (const category of props.categories) {
        for (const item of category.items) {
            map.set(item.id, next++);
        }
    }

    return map;
});

const options = computed(() => [
    { value: ALL, label: 'All', count: total.value },
    ...props.categories.map((category) => ({ value: category.id, label: category.title, count: category.items.length })),
]);

const visibleCategories = computed(() =>
    selected.value === ALL ? props.categories : props.categories.filter((category) => category.id === selected.value),
);

const visibleCount = computed(() => visibleCategories.value.reduce((sum, category) => sum + category.items.length, 0));

const featured = computed(() => {
    const category = visibleCategories.value.find((candidate) => candidate.items.length > 0);

    return category ? { project: category.items[0], category: category.title } : null;
});

const status = computed(() => {
    const noun = visibleCount.value === 1 ? 'project' : 'projects';
    const scope = selected.value === ALL ? 'in all categories' : `in ${visibleCategories.value[0]?.title ?? ''}`;

    return `Showing ${visibleCount.value} ${noun} ${scope}.`;
});
</script>

<template>
    <div class="page page--portfolio">
        <Head title="Portfolio" />
        <PageHeader :kicker="pageKicker('Portfolio')" :lede="profile.intros?.portfolio" layout="split">Selected work</PageHeader>

        <template v-if="total > 0">
            <FilterBar v-model="selected" :options="options" label="Filter projects by category" />
            <p class="visually-hidden" role="status" aria-live="polite">{{ status }}</p>

            <FeaturedProject
                v-if="featured"
                :key="featured.project.id"
                :project="featured.project"
                :number="numbers.get(featured.project.id)"
                :category="featured.category"
                heading-id="featured-title"
            />

            <section
                v-for="category in visibleCategories"
                :key="category.id"
                class="project-group"
                :aria-labelledby="`category-${category.id}`"
            >
                <h2 :id="`category-${category.id}`" class="project-group__title">{{ category.title }}</h2>
                <ol class="project-group__list">
                    <li v-for="item in category.items" :key="item.id">
                        <ProjectRow :project="item" :number="numbers.get(item.id)" />
                    </li>
                </ol>
            </section>
        </template>
        <p v-else class="empty-state">No projects yet.</p>
    </div>
</template>
