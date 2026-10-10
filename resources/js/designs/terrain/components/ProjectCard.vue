<script setup>
import { computed } from 'vue';
import { paragraphs } from '../lib/format';
import MonogramBadge from './MonogramBadge.vue';
import ProjectLinks from './ProjectLinks.vue';

/** Portfolio grid card: monogram, title, subtitle, a short description and links. */
const props = defineProps({
    item: { type: Object, required: true },
    headingLevel: { type: Number, default: 3 },
});

const summary = computed(() => paragraphs(props.item.description)[0] ?? '');
</script>

<template>
    <article class="card card--leaf card--default project">
        <MonogramBadge :text="item.title" />
        <component :is="`h${headingLevel}`" class="project__title">{{ item.title }}</component>
        <p v-if="item.subtitle" class="project__subtitle">{{ item.subtitle }}</p>
        <p v-if="summary" class="project__summary">{{ summary }}</p>
        <ProjectLinks class="project__links" :item="item" />
    </article>
</template>
