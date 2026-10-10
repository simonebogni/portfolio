<script setup lang="ts">
import type { Project, ProjectCategory } from '@core/entities/project';
import { CaseCard, TextLink } from '@designs/blueprint/shared/ui';
import { projectKind, projectMeta } from '../model/card';

/** A project as a full case card, with its live and source links. */
defineProps<{
    project: Project;
    category: ProjectCategory;
}>();
</script>

<template>
    <CaseCard
        :kind="projectKind(project, category)"
        :title="project.title"
        :summary="project.description"
        :meta="projectMeta(project, category)"
    >
        <template v-if="project.liveUrl || project.gitRepoUrl" #actions>
            <TextLink v-if="project.liveUrl" :href="project.liveUrl" :context="project.title">View it live</TextLink>
            <TextLink v-if="project.gitRepoUrl" :href="project.gitRepoUrl" :context="project.title">Source code</TextLink>
        </template>
    </CaseCard>
</template>
