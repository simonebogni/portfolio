<script setup>
import { useTheme } from '../composables/useTheme';
import BpIcon from './BpIcon.vue';

/** Light/dark switch. The icon shows the theme you switch to. */
const { isDark, toggle, toggleLabel } = useTheme();
</script>

<template>
    <button class="icon-button" type="button" :aria-pressed="isDark" :aria-label="toggleLabel" @click="toggle">
        <BpIcon :name="isDark ? 'sun' : 'moon'" />
    </button>
</template>
