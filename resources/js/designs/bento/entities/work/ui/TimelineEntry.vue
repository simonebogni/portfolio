<script setup lang="ts">
import { ChipList } from '@designs/bento/shared/ui';

/**
 * One role in the work history: title, period, organisation, rich-text description and tags.
 * `html` is trusted rich text written by the site owner in the admin panel.
 */
withDefaults(
    defineProps<{
        title: string;
        period?: string;
        organisation?: string;
        html?: string | null;
        tags?: string[];
        current?: boolean;
    }>(),
    { period: '', organisation: '', html: null, tags: () => [], current: false },
);
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
        <div v-if="html" class="entry__body prose" v-html="html"></div>
        <slot></slot>
        <ChipList v-if="tags.length" :items="tags" label="Technologies and topics" size="sm" surface="raised" :limit="6" />
    </li>
</template>
