<script setup>
import { useTheme } from '../composables/useTheme';

/**
 * "Dark mode" toggle button. aria-pressed carries the state; the small switch
 * shows it visually by the knob's position, not only by colour.
 */
const { isDark, toggle } = useTheme();
</script>

<template>
    <button class="text-button theme-toggle" type="button" :aria-pressed="isDark ? 'true' : 'false'" @click="toggle">
        <span class="theme-toggle__switch" aria-hidden="true"><span class="theme-toggle__knob" /></span>
        Dark mode
    </button>
</template>
