<script setup lang="ts">
import { computed } from 'vue';
import { type IconName, iconPaths } from './icons';

/**
 * Decorative line icon (24×24 grid, stroke = currentColor).
 * Always aria-hidden: the control that contains it carries the accessible name.
 */
const props = withDefaults(defineProps<{ name: IconName; size?: number | string }>(), { size: 20 });

const d = computed<string[]>(() => iconPaths[props.name] ?? iconPaths.spark);
</script>

<template>
    <svg
        class="icon"
        :width="size"
        :height="size"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        aria-hidden="true"
        focusable="false"
    >
        <path v-for="(path, index) in d" :key="index" :d="path" />
    </svg>
</template>
