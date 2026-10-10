<script setup>
import TagList from './TagList.vue';

/**
 * One role on the work timeline: a big year on the left, the title,
 * organisation, description (default slot) and tags on the right.
 * `highlight` gives the row a tinted background (used for the current role).
 */
defineProps({
    year: { type: String, required: true },
    period: { type: String, default: '' },
    title: { type: String, required: true },
    org: { type: String, default: '' },
    tags: { type: Array, default: () => [] },
    highlight: { type: Boolean, default: false },
    headingLevel: { type: Number, default: 3 },
});
</script>

<template>
    <li class="timeline-entry" :class="{ 'timeline-entry--highlight': highlight }">
        <p class="timeline-entry__when">
            <span class="timeline-entry__year display">{{ year }}</span>
            <span v-if="period" class="timeline-entry__period">{{ period }}</span>
        </p>
        <div class="timeline-entry__body">
            <component :is="`h${headingLevel}`" class="timeline-entry__title display">{{ title }}</component>
            <p v-if="org" class="timeline-entry__org">{{ org }}</p>
            <div class="timeline-entry__text"><slot /></div>
            <TagList :tags="tags" />
        </div>
    </li>
</template>

