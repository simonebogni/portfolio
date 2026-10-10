<script setup lang="ts">
import type { ProjectCategory } from '@core/entities/project';
import { usePortfolioFilter } from '@core/features/portfolio-filter';
import { filterStatus, PortfolioFilter } from '@designs/bento/features/portfolio-filter';
import { ContactTile } from '@designs/bento/widgets/contact-tile';
import { ProjectGrid } from '@designs/bento/widgets/project-grid';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{ categories: ProjectCategory[] }>();

const { selected, options, selectedOption, isAll, visibleProjects } = usePortfolioFilter(() => props.categories, { key: 'name' });

const status = computed(() => filterStatus(visibleProjects.value.length, selectedOption.value?.label, isAll.value));
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
        <ProjectGrid :projects="visibleProjects" />
        <ContactTile class="contact--standalone" title="Let's build the next one together." heading-id="portfolio-contact-title" />
    </div>
</template>
