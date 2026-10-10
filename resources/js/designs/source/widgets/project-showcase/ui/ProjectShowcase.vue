<script setup lang="ts">
import type { ProjectCategory } from '@core/entities/project';
import { pluralize } from '@core/shared/lib';
import { FeaturedProject, ProjectCard } from '@designs/source/entities/project';
import { SectionHeading } from '@designs/source/shared/ui';
import { computed } from 'vue';
import { featuredOf, sectionsOf } from '../model/showcase';

/** The selected categories: the first project shown large, the others in one grid per category. */
const props = defineProps<{ categories: readonly ProjectCategory[] }>();

const featured = computed(() => featuredOf(props.categories));
const sections = computed(() => sectionsOf(props.categories, featured.value));

function comment(section: { items: readonly unknown[]; gridItems: readonly unknown[] }): string {
    const count = pluralize(section.items.length, 'project');

    return section.gridItems.length < section.items.length ? `${count} · 1 featured above` : count;
}
</script>

<template>
    <FeaturedProject v-if="featured" :key="featured.item.id" :item="featured.item" :category="featured.category" />

    <section v-for="category in sections" :key="category.id" :aria-labelledby="`category-${category.id}`">
        <SectionHeading :id="`category-${category.id}`" :title="category.title" :comment="comment(category)" size="sm" />
        <ul class="project-grid">
            <ProjectCard v-for="item in category.gridItems" :key="item.id" :item="item" />
        </ul>
    </section>
</template>
