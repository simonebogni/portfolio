<script setup>
import { computed } from 'vue';
import { padNumber, paragraphs } from '../lib/format';

/**
 * Index row for a project: number, title, one-line summary and an arrow.
 * The whole row links to the live site, or to the source code when there is no live site.
 */
const props = defineProps({
    project: { type: Object, required: true },
    number: { type: Number, required: true },
});

const link = computed(() => {
    if (props.project.liveUrl) {
        return { href: props.project.liveUrl, hint: 'live site' };
    }

    return props.project.gitRepoUrl ? { href: props.project.gitRepoUrl, hint: 'source code' } : null;
});

const summary = computed(() => props.project.subtitle || paragraphs(props.project.description)[0] || '');
</script>

<template>
    <component
        :is="link ? 'a' : 'div'"
        class="project-row"
        :class="{ 'project-row--static': !link }"
        :href="link?.href"
        :rel="link ? 'noopener' : undefined"
    >
        <span class="project-row__number" aria-hidden="true">{{ padNumber(number) }}</span>
        <h3 class="project-row__title">
            {{ project.title }}<span v-if="link" class="visually-hidden"> ({{ link.hint }})</span>
        </h3>
        <p v-if="summary" class="project-row__summary">{{ summary }}</p>
        <span v-if="link" class="project-row__arrow" aria-hidden="true">↗</span>
    </component>
</template>
