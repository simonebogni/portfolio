<script setup lang="ts">
import { PageHeader } from '@designs/terrain/shared/ui';
import { ProjectCatalog } from '@designs/terrain/widgets/project-catalog';
import { Head } from '@inertiajs/vue3';
import type { PortfolioProps } from '../model/props';

defineProps<PortfolioProps>();
</script>

<template>
    <div class="page page-portfolio">
        <Head title="Portfolio" />
        <PageHeader
            eyebrow="Things I’ve grown"
            title="Portfolio"
            intro="Projects I’ve built, grouped by kind. Pick a category to narrow the list."
        />

        <ProjectCatalog v-if="categories.length" :categories="categories" />
        <p v-else class="empty-state">No projects to show yet.</p>
    </div>
</template>
