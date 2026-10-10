<script setup>
import ChipList from './ChipList.vue';

/**
 * One role in the work history: title, period, organisation, rich-text description and tags.
 * `html` is trusted rich text written by the site owner in the admin panel.
 */
defineProps({
    title: { type: String, required: true },
    period: { type: String, default: '' },
    organisation: { type: String, default: '' },
    html: { type: String, default: null },
    tags: { type: Array, default: () => [] },
    current: { type: Boolean, default: false },
});
</script>

<template>
    <li class="entry">
        <div class="entry__head">
            <h3 class="entry__title">{{ title }}</h3>
            <p class="entry__when">
                <span v-if="current" class="badge">Current</span>
                {{ period }}
            </p>
        </div>
        <p v-if="organisation" class="entry__org">{{ organisation }}</p>
        <div v-if="html" class="entry__body prose" v-html="html" />
        <slot />
        <ChipList v-if="tags.length" :items="tags" label="Technologies and topics" size="sm" surface="raised" :limit="6" />
    </li>
</template>
