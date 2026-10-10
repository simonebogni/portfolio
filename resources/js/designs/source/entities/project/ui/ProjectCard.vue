<script setup lang="ts">
import type { Project } from '@core/entities/project';
import { formatYear } from '@core/shared/lib';
import { BaseCard, ExpandableText, TextLink } from '@designs/source/shared/ui';
import { computed } from 'vue';
import ProjectCover from './ProjectCover.vue';

/**
 * Portfolio item in a grid. Long descriptions are clamped (ExpandableText).
 */
const props = withDefaults(defineProps<{ item: Project; headingLevel?: number }>(), { headingLevel: 3 });

const year = computed(() => formatYear(props.item.date));
</script>

<template>
    <BaseCard as="li" padding="none" class="project-card">
        <ProjectCover :title="item.title" :image-url="item.coverImgUrl" />
        <div class="project-card__body">
            <p v-if="year" class="project-card__meta"><time :datetime="item.date ?? undefined">{{ year }}</time></p>
            <component :is="`h${headingLevel}`" class="project-card__title">{{ item.title }}</component>
            <p v-if="item.subtitle" class="project-card__subtitle">{{ item.subtitle }}</p>
            <ExpandableText v-if="item.description" class="project-card__text" :text="item.description" :context="item.title" />
            <div v-if="item.liveUrl || item.gitRepoUrl" class="project-card__links text-link-row">
                <TextLink v-if="item.liveUrl" :href="item.liveUrl" :context="item.title">Live demo</TextLink>
                <TextLink v-if="item.gitRepoUrl" :href="item.gitRepoUrl" :context="item.title">Source code</TextLink>
            </div>
        </div>
    </BaseCard>
</template>
