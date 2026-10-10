<script setup>
import BaseIcon from './BaseIcon.vue';

/** "Live site" and "Source code" text links of a portfolio item; both open in a new tab. */
defineProps({
    item: { type: Object, required: true },
});
</script>

<template>
    <ul v-if="item.liveUrl || item.gitRepoUrl" class="project-links plain-list">
        <li v-if="item.liveUrl">
            <a class="text-link" :href="item.liveUrl" target="_blank" rel="noopener noreferrer">
                Live site<span class="visually-hidden">: {{ item.title }} (opens in a new tab)</span>
                <BaseIcon name="external" :size="16" />
            </a>
        </li>
        <li v-if="item.gitRepoUrl">
            <a class="text-link" :href="item.gitRepoUrl" target="_blank" rel="noopener noreferrer">
                Source code<span class="visually-hidden">: {{ item.title }} (opens in a new tab)</span>
                <BaseIcon name="external" :size="16" />
            </a>
        </li>
    </ul>
</template>
