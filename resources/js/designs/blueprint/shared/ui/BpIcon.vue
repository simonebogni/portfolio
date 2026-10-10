<script setup lang="ts">
/**
 * Decorative line icon (always aria-hidden: pair it with visible or sr-only text).
 */
const { size = 20 } = defineProps<{
    name: string;
    size?: number | string;
}>();

const paths: Record<string, string> = {
    sun: '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
    moon: '<path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z"/>',
    menu: '<path d="M4 7h16M4 12h16M4 17h16"/>',
    close: '<path d="M6 6l12 12M18 6L6 18"/>',
    dot: '<circle cx="12" cy="12" r="4"/>',
    check: '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
    arrow: '<path d="M5 12h14M13 6l6 6-6 6"/>',
    external: '<path d="M7 17L17 7M9 7h8v8"/>',
    team: '<circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6M15 20c0-2.5 1-4.5 3-5"/>',
    partnership: '<path d="M4 12h6M14 12h6M10 9v6M14 9v6"/><rect x="2" y="7" width="8" height="10" rx="2"/><rect x="14" y="7" width="8" height="10" rx="2"/>',
    code: '<path d="M8 7l-5 5 5 5M16 7l5 5-5 5M13 5l-2 14"/>',
};
</script>

<template>
    <svg
        class="bp-icon"
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
        v-html="paths[name] ?? ''"
    />
</template>
