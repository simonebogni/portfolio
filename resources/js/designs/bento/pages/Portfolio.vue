<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import ContactTile from '../components/ContactTile.vue';
import PortfolioFilter from '../components/PortfolioFilter.vue';
import ProjectCard from '../components/ProjectCard.vue';

const props = defineProps({
    categories: { type: Array, required: true },
});

const ALL = 'all';
const selected = ref(ALL);

const allProjects = computed(() =>
    props.categories.flatMap((category) => category.items.map((item) => ({ ...item, categoryName: category.name, categoryTitle: category.title }))),
);

const options = computed(() => [
    { value: ALL, label: 'All', count: allProjects.value.length },
    ...props.categories.map((category) => ({ value: category.name, label: category.title, count: category.items.length })),
]);

const projects = computed(() =>
    selected.value === ALL ? allProjects.value : allProjects.value.filter((project) => project.categoryName === selected.value),
);

/**
 * Bento sizes for n cards, so every row is filled: a wide featured card with two
 * cards beside it, then rows of two halves or three thirds.
 */
function sizesFor(count) {
    if (count === 1) {
        return ['full'];
    }

    if (count === 2) {
        return ['half', 'half'];
    }

    const sizes = ['wide', 'third', 'third'];
    let remaining = count - 3;

    while (remaining > 0) {
        if (remaining === 1) {
            sizes.push('full');
            remaining -= 1;
        } else if (remaining === 2 || remaining === 4) {
            sizes.push('half', 'half');
            remaining -= 2;
        } else {
            sizes.push('third', 'third', 'third');
            remaining -= 3;
        }
    }

    return sizes;
}

const cards = computed(() => {
    const sizes = sizesFor(projects.value.length);

    return projects.value.map((project, index) => ({
        project,
        size: sizes[index],
        featured: index === 0 && projects.value.length > 2,
        inverseArt: index % 4 === 1,
        kind: [index === 0 && projects.value.length > 2 ? 'Featured' : null, project.categoryTitle].filter(Boolean).join(' · '),
    }));
});

const status = computed(() => {
    const count = projects.value.length;
    const noun = count === 1 ? 'project' : 'projects';
    const option = options.value.find((item) => item.value === selected.value);

    return selected.value === ALL ? `Showing all ${count} ${noun}` : `Showing ${count} ${noun}: ${option?.label}`;
});
</script>

<template>
    <div class="page page-portfolio">
        <Head title="Portfolio" />
        <header class="page-head">
            <div class="page-head__text">
                <h1 class="display">Portfolio</h1>
                <p class="lead">Projects grouped by {{ categories.length === 1 ? 'one category' : `${categories.length} categories` }}: {{ categories.map((category) => category.title).join(', ') }}.</p>
            </div>
            <PortfolioFilter v-if="categories.length > 1" v-model="selected" :options="options" label="Filter projects by category" />
        </header>
        <p class="visually-hidden" role="status" aria-live="polite">{{ status }}</p>
        <ul class="bento" aria-label="Projects">
            <ProjectCard
                v-for="card in cards"
                :key="card.project.id"
                :project="card.project"
                :size="card.size"
                :featured="card.featured"
                :inverse-art="card.inverseArt"
                :kind="card.kind"
            />
        </ul>
        <ContactTile class="contact--standalone" title="Let's build the next one together." heading-id="portfolio-contact-title" />
    </div>
</template>
