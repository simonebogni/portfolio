<script setup lang="ts">
import type { ProjectInCategory } from '@core/entities/project';
import { ProjectCard } from '@designs/bento/entities/project';
import { computed } from 'vue';
import { projectCards } from '../model/cards';

/** The portfolio as a bento list of project cards, sized so every row is full. */
const props = defineProps<{ projects: ProjectInCategory[] }>();

const cards = computed(() => projectCards(props.projects));
</script>

<template>
    <ul class="bento" aria-label="Projects">
        <ProjectCard
            v-for="card in cards"
            :key="card.project.id"
            :project="card.project"
            :size="card.size"
            :featured="card.featured"
            :inverse-art="card.inverseArt"
            :kind="card.kind"
        />
    </ul>
</template>
