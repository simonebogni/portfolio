<script setup>
import { computed } from 'vue';
import { isPlaceholder } from '../lib/copy';
import ActionLink from './ActionLink.vue';
import DefinitionRows from './DefinitionRows.vue';
import Eyebrow from './Eyebrow.vue';

/** Dark two-column panel highlighting one engagement, with key facts on the right. */
const props = defineProps({
    id: { type: String, required: true },
    eyebrow: { type: String, default: '' },
    title: { type: String, required: true },
    summary: { type: String, default: '' },
    facts: { type: Array, default: () => [] },
    href: { type: String, default: '' },
    linkLabel: { type: String, default: 'Read the story' },
});

const titlePlaceholder = computed(() => isPlaceholder(props.title));
const summaryPlaceholder = computed(() => isPlaceholder(props.summary));
</script>

<template>
    <article class="featured tone-deep" :aria-labelledby="id">
        <div class="featured__main">
            <Eyebrow v-if="eyebrow" tone="deep">{{ eyebrow }}</Eyebrow>
            <h2 :id="id" class="featured__title" :class="{ 'is-placeholder': titlePlaceholder }">{{ title }}</h2>
            <p v-if="summary" class="featured__summary" :class="{ 'is-placeholder': summaryPlaceholder }">{{ summary }}</p>
            <ActionLink v-if="href" class="featured__action" :href="href" variant="inverse">
                {{ linkLabel }}<span class="visually-hidden">: {{ title }}</span>
            </ActionLink>
        </div>
        <DefinitionRows class="featured__facts" :items="facts" variant="deep" />
    </article>
</template>
