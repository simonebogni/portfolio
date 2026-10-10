<script setup lang="ts">
import type { ProjectInCategory } from '@core/entities/project';
import { type FeaturedCaseStudy, FeaturedCaseCard } from '@designs/blueprint/entities/profile';
import { ProjectCard, ProjectLink } from '@designs/blueprint/entities/project';

/**
 * The case studies: the featured leadership case study and the `cards` as full case cards,
 * then the `more` projects as a compact list under "More projects".
 */
defineProps<{
    featured: FeaturedCaseStudy | null;
    cards: readonly ProjectInCategory[];
    more: readonly ProjectInCategory[];
}>();
</script>

<template>
    <ol v-if="featured || cards.length" class="cases">
        <FeaturedCaseCard v-if="featured" :study="featured" />
        <ProjectCard
            v-for="{ project, category } in cards"
            :key="project.id"
            :project="project"
            :category="category"
        />
    </ol>

    <section v-if="more.length" class="more" aria-labelledby="more-title">
        <h2 id="more-title" class="more__title">More projects</h2>
        <ul class="link-list">
            <li v-for="{ project, category } in more" :key="project.id">
                <ProjectLink :project="project" :category="category" />
            </li>
        </ul>
    </section>
</template>
