<script setup>
import { useTheme } from '../composables/useTheme';

/** Square light/dark switch. The choice is saved by useTheme. */
const { isDark, toggle, toggleLabel } = useTheme();
</script>

<template>
    <button class="icon-button theme-toggle" type="button" :aria-pressed="isDark" :aria-label="toggleLabel" :title="toggleLabel" @click="toggle">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="square" aria-hidden="true" focusable="false">
            <circle cx="12" cy="12" r="8" />
            <path d="M12 4v16" />
            <path d="M12 4a8 8 0 0 1 0 16z" fill="currentColor" />
        </svg>
    </button>
</template>
