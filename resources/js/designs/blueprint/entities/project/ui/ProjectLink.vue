<script setup lang="ts">
import type { Project, ProjectCategory } from '@core/entities/project';
import { isExternal } from '@core/shared/lib';
import { BpIcon } from '@designs/blueprint/shared/ui';
import { computed } from 'vue';
import { primaryUrl, projectLine } from '../model/card';

/** A project as one compact row of the "More projects" list: a link when it has one. */
const props = defineProps<{
    project: Project;
    category: ProjectCategory;
}>();

const url = computed(() => primaryUrl(props.project));
const external = computed(() => isExternal(url.value));
</script>

<template>
    <component
        :is="url ? 'a' : 'div'"
        class="link-list__item"
        :href="url || undefined"
        :target="external ? '_blank' : undefined"
        :rel="external ? 'noopener noreferrer' : undefined"
    >
        <span>
            <b>{{ project.title }}</b>
            <span class="link-list__meta">{{ projectLine(project, category) }}</span>
        </span>
        <template v-if="url">
            <span v-if="external" class="visually-hidden"> (opens in a new tab)</span>
            <BpIcon name="external" :size="18" />
        </template>
    </component>
</template>
