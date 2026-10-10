<script setup lang="ts">
import { type IconName, iconPaths } from './icons';

/**
 * Inline stroke icon. Always decorative: give the surrounding control an accessible name.
 */
const { size = 20 } = defineProps<{
    name: IconName;
    size?: number | string;
}>();
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
        v-html="iconPaths[name]"
    />
</template>
