<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import FeaturedProject from '../components/FeaturedProject.vue';
import PageHeader from '../components/PageHeader.vue';
import PortfolioFilter from '../components/PortfolioFilter.vue';
import ProjectCard from '../components/ProjectCard.vue';
import SectionHeading from '../components/SectionHeading.vue';

const props = defineProps({
    categories: { type: Array, required: true },
});

const ALL = 'all';

const profile = computed(() => usePage().props.profile);
const selected = ref(ALL);
const announce = ref('');

const total = computed(() => props.categories.reduce((sum, category) => sum + category.items.length, 0));

const filterOptions = computed(() => [
    { value: ALL, label: 'All', count: total.value },
    ...props.categories.map((category) => ({ value: category.name, label: category.title, count: category.items.length })),
]);

const visibleCategories = computed(() =>
    selected.value === ALL ? props.categories : props.categories.filter((category) => category.name === selected.value),
);

// The first project of the selection is shown large, and left out of its grid.
const featured = computed(() => {
    const category = visibleCategories.value.find((candidate) => candidate.items.length > 0);

    return category ? { item: category.items[0], category: category.title } : null;
});

const sections = computed(() =>
    visibleCategories.value
        .map((category) => ({
            ...category,
            gridItems: category.items.filter((item) => item.id !== featured.value?.item.id),
        }))
        .filter((category) => category.gridItems.length > 0),
);

function plural(count) {
    return `${count} ${count === 1 ? 'project' : 'projects'}`;
}

function onFilter(value) {
    selected.value = value;
    const option = filterOptions.value.find((candidate) => candidate.value === value);
    announce.value = `Showing ${plural(option.count)}${value === ALL ? '' : ` in ${option.label}`}.`;
}
</script>

<template>
    <div class="page page-portfolio">
        <Head title="Portfolio" />
        <PageHeader eyebrow="$ ls ./projects" title="Portfolio" :intro="profile.intros?.portfolio" tight />

        <template v-if="total > 0">
            <PortfolioFilter :model-value="selected" :options="filterOptions" label="Filter projects by category" @update:model-value="onFilter" />
            <p class="visually-hidden" role="status" aria-live="polite">{{ announce }}</p>

            <FeaturedProject v-if="featured" :key="featured.item.id" :item="featured.item" :category="featured.category" />

            <section v-for="category in sections" :key="category.id" :aria-labelledby="`category-${category.id}`">
                <SectionHeading :id="`category-${category.id}`" :title="category.title" :comment="category.gridItems.length < category.items.length ? `${plural(category.items.length)} · 1 featured above` : plural(category.items.length)" size="sm" />
                <ul class="project-grid">
                    <ProjectCard v-for="item in category.gridItems" :key="item.id" :item="item" />
                </ul>
            </section>
        </template>
        <p v-else class="empty">No projects yet.</p>
    </div>
</template>
