<script setup>
import { computed } from 'vue';
import { firstSentence } from '../lib/copy';
import { formatYear } from '../lib/format';

/**
 * One project in the portfolio list. The whole row is clickable through the title link
 * (live site, else source code); a separate "Source" link is shown when both exist.
 */
const props = defineProps({
    item: { type: Object, required: true },
    category: { type: String, default: '' },
});

const primaryUrl = computed(() => props.item.liveUrl || props.item.gitRepoUrl || '');
const primaryKind = computed(() => (props.item.liveUrl ? 'live site' : 'source code'));
const summary = computed(() => firstSentence(props.item.description) || props.item.subtitle || '');
/** The subtitle goes in the meta line, unless it already stands in for a missing description. */
const subtitle = computed(() => (props.item.description ? props.item.subtitle : ''));
const tech = computed(() => (props.item.tags ?? []).slice(0, 4).join(', '));
const year = computed(() => formatYear(props.item.date));
</script>

<template>
    <li class="work-row" :class="{ 'work-row--linked': primaryUrl }">
        <h3 class="work-row__title">
            <a v-if="primaryUrl" class="work-row__link" :href="primaryUrl">
                {{ item.title }}<span class="visually-hidden"> ({{ primaryKind }})</span>
            </a>
            <template v-else>{{ item.title }}</template>
        </h3>
        <p class="work-row__summary">{{ summary }}</p>
        <p class="work-row__meta">
            <b>{{ category }}</b>
            <span v-if="subtitle">{{ subtitle }}</span>
            <span>{{ [year, tech].filter(Boolean).join(' · ') }}</span>
            <a v-if="item.liveUrl && item.gitRepoUrl" class="work-row__source" :href="item.gitRepoUrl">
                Source<span class="visually-hidden"> code of {{ item.title }}</span>
            </a>
        </p>
        <span v-if="primaryUrl" class="work-row__arrow" aria-hidden="true">↗</span>
    </li>
</template>
