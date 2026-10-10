<script setup lang="ts">
import { type IconName, iconPaths } from './icons';

/**
 * Inline stroke icon (24×24 grid, 2px stroke). Always decorative: give the
 * surrounding control an accessible name instead.
 */
const props = withDefaults(defineProps<{ name: IconName; size?: number | string }>(), { size: 20 });
</script>

<template>
    <svg
        class="icon"
        :width="props.size"
        :height="props.size"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        aria-hidden="true"
        focusable="false"
    >
        <template v-if="name === 'sun'">
            <circle cx="12" cy="12" r="4" />
            <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4" />
        </template>
        <template v-else>
            <circle v-if="name === 'pin'" cx="12" cy="10" r="2.5" />
            <rect v-if="name === 'linkedin'" x="3" y="3" width="18" height="18" rx="3" />
            <rect v-if="name === 'mail'" x="3" y="5" width="18" height="14" rx="2" />
            <path v-for="(d, index) in iconPaths[name] ?? []" :key="index" :d="d" />
        </template>
    </svg>
</template>
