<script setup lang="ts">
import type { Project } from '@core/entities/project';
import { AppButton, BaseCard, ChipList, ExpandableText } from '@designs/source/shared/ui';
import ProjectCover from './ProjectCover.vue';

/** Wide card for the first project of the selection, with its tags and links. */
const props = defineProps<{ item: Project; category: string }>();

const titleId = `featured-${props.item.id}`;
</script>

<template>
    <BaseCard as="article" padding="none" class="featured" :aria-labelledby="titleId">
        <ProjectCover :title="item.title" :image-url="item.coverImgUrl" mock />
        <div class="featured__body">
            <span class="overline">Featured · {{ category }}</span>
            <h2 :id="titleId" class="featured__title">{{ item.title }}</h2>
            <p v-if="item.subtitle" class="project-card__subtitle">{{ item.subtitle }}</p>
            <ExpandableText v-if="item.description" class="featured__text" :text="item.description" :clamp-from="360" :lines="6" :context="item.title" />
            <ChipList :items="item.tags" />
            <div v-if="item.liveUrl || item.gitRepoUrl" class="btn-row btn-row--stack">
                <AppButton v-if="item.liveUrl" :href="item.liveUrl" icon="arrowRight">Live demo<span class="visually-hidden"> of {{ item.title }}</span></AppButton>
                <AppButton v-if="item.gitRepoUrl" :href="item.gitRepoUrl" variant="ghost">Source code<span class="visually-hidden"> of {{ item.title }}</span></AppButton>
            </div>
        </div>
    </BaseCard>
</template>
