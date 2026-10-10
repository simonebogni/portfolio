<script setup lang="ts">
import type { ProjectCategory } from '@core/entities/project';
import { usePortfolioFilter } from '@core/features/portfolio-filter';
import { ProjectFeature, ProjectRow } from '@designs/kinetic/entities/project';
import { FilterGroup, filterStatus } from '@designs/kinetic/features/portfolio-filter';
import { computed } from 'vue';

/**
 * The portfolio: the category filter, the first visible project as the featured card, then the
 * numbered index of every visible project. Renders the empty state when there are no projects.
 */
const props = defineProps<{
    categories: readonly ProjectCategory[];
}>();

const { selected, options, selectedOption, isAll, visibleProjects, total } = usePortfolioFilter(() => props.categories, { key: 'id' });

const featured = computed(() => visibleProjects.value[0] ?? null);
const status = computed(() => filterStatus(visibleProjects.value.length, isAll.value, selectedOption.value?.label));
</script>

<template>
    <template v-if="total">
        <FilterGroup v-model="selected" :options="options" label="Filter projects by category" :status="status" />

        <ProjectFeature v-if="featured" :key="featured.project.id" :item="featured.project" :category="featured.category.title" :index="1" />

        <h2 id="index-title" class="visually-hidden">All projects</h2>
        <ol class="project-index plain-list" aria-labelledby="index-title">
            <ProjectRow
                v-for="(entry, index) in visibleProjects"
                :key="entry.project.id"
                :item="entry.project"
                :category="entry.category.title"
                :index="index + 1"
            />
        </ol>
    </template>
    <p v-else class="empty-state">No projects to show yet.</p>
</template>
