<script setup lang="ts">
import type { ProjectCategory } from '@core/entities/project';
import { useSourceProfile } from '@designs/source/entities/profile';
import { PortfolioFilter, useAnnouncedFilter } from '@designs/source/features/portfolio-filter';
import { PageHeader } from '@designs/source/shared/ui';
import { ProjectShowcase } from '@designs/source/widgets/project-showcase';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{ categories: ProjectCategory[] }>();

const { profile } = useSourceProfile();
const { selected, options, total, visibleCategories, announce, onFilter } = useAnnouncedFilter(() => props.categories);
</script>

<template>
    <div class="page page-portfolio">
        <Head title="Portfolio" />
        <PageHeader eyebrow="$ ls ./projects" title="Portfolio" :intro="profile.intros?.portfolio" tight />

        <template v-if="total > 0">
            <PortfolioFilter :model-value="selected" :options="options" label="Filter projects by category" @update:model-value="onFilter" />
            <p class="visually-hidden" role="status" aria-live="polite">{{ announce }}</p>

            <ProjectShowcase :categories="visibleCategories" />
        </template>
        <p v-else class="empty">No projects yet.</p>
    </div>
</template>
