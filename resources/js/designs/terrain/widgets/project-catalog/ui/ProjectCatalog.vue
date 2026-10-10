<script setup lang="ts">
import type { ProjectCategory } from '@core/entities/project';
import { usePortfolioFilter } from '@core/features/portfolio-filter';
import { pluralize } from '@core/shared/lib';
import { FeaturedProject, ProjectCard } from '@designs/terrain/entities/project';
import { filterStatus, PortfolioFilter } from '@designs/terrain/features/portfolio-filter';
import { SectionHeading } from '@designs/terrain/shared/ui';
import { computed } from 'vue';

/**
 * The portfolio: category filter with its live region, the featured project (unfiltered view
 * only) and one grid of project cards per visible category.
 */
const props = defineProps<{
    categories: ProjectCategory[];
}>();

const { selected, options, isAll, visibleCategories, visibleProjects } = usePortfolioFilter(() => props.categories, {
    key: 'id',
    allLabel: 'All projects',
});

/** The top item of the first category leads the unfiltered view. */
const featured = computed(() => (isAll.value ? (props.categories[0]?.items[0] ?? null) : null));
const featuredEyebrow = computed(() => `Featured · ${props.categories[0]?.title ?? ''}`);

const status = computed(() => filterStatus(visibleProjects.value.length, isAll.value, visibleCategories.value[0]?.title));
</script>

<template>
    <PortfolioFilter v-model="selected" :options="options" label="Filter projects by category" />
    <p class="visually-hidden" role="status" aria-live="polite">{{ status }}</p>

    <FeaturedProject v-if="featured" :item="featured" :eyebrow="featuredEyebrow" />

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
