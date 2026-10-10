<script setup lang="ts">
import type { ProjectCategory } from '@core/entities/project';
import { featuredCaseStudy, useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { FilterStatus, PortfolioFilter, useCaseStudyFilter } from '@designs/blueprint/features/portfolio-filter';
import { PageHeader } from '@designs/blueprint/shared/ui';
import { CaseStudies } from '@designs/blueprint/widgets/case-studies';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    categories: ProjectCategory[];
}>();

const { profile, teamSize, fill } = useBlueprintProfile();

/** The configured leadership case study, or null. */
const featured = computed(() => featuredCaseStudy(profile.value, teamSize.value, fill));

/**
 * With "All", the first (highest priority) category gets full case cards and the
 * rest are listed compactly under "More projects". A single category shows only cards.
 */
const { selected, options, showFeatured, cards, more, resultCount, resultLabel } = useCaseStudyFilter(
    () => props.categories,
    () => featured.value !== null,
);
</script>

<template>
    <div class="page page--portfolio">
        <Head title="Case studies" />
        <PageHeader tag="Case studies" title="The work, the team and the people behind it." :intro="fill(profile.page_intros.portfolio)">
            <PortfolioFilter v-model="selected" :options="options" />
        </PageHeader>

        <div class="container">
            <FilterStatus :text="resultLabel" />

            <CaseStudies :featured="showFeatured ? featured : null" :cards="cards" :more="more" />

            <p v-if="!resultCount" class="empty-state">No projects in this category yet.</p>
        </div>
    </div>
</template>
