<script setup>
import { computed } from 'vue';
import { formatYear, pad2 } from '../lib/format';
import SmartLink from './SmartLink.vue';

/**
 * One row of the project index. The title links to the live site (or the
 * source code when there is no live site) and the whole row is clickable;
 * a second "Code" link appears when both exist.
 */
const props = defineProps({
    item: { type: Object, required: true },
    index: { type: Number, required: true },
    category: { type: String, default: '' },
});

const primaryUrl = computed(() => props.item.liveUrl || props.item.gitRepoUrl || null);
const secondaryUrl = computed(() => (props.item.liveUrl && props.item.gitRepoUrl ? props.item.gitRepoUrl : null));
const meta = computed(() => [props.category, formatYear(props.item.date)].filter(Boolean).join(' · '));
</script>

<template>
    <li class="project-row" :class="{ 'project-row--linked': primaryUrl }">
        <span class="project-row__index display" aria-hidden="true">{{ pad2(index) }}</span>
        <div class="project-row__main">
            <h3 class="project-row__title display">
                <SmartLink v-if="primaryUrl" :href="primaryUrl" class="project-row__link">{{ item.title }}</SmartLink>
                <template v-else>{{ item.title }}</template>
            </h3>
            <p v-if="item.subtitle" class="project-row__subtitle">{{ item.subtitle }}</p>
        </div>
        <p class="project-row__meta">
            <span class="label">{{ meta }}</span>
            <SmartLink v-if="secondaryUrl" :href="secondaryUrl" class="project-row__secondary">Code<span class="visually-hidden"> of {{ item.title }}</span></SmartLink>
        </p>
        <span class="project-row__arrow display" aria-hidden="true">{{ primaryUrl ? '↗' : '' }}</span>
    </li>
</template>
