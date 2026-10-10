<script setup>
import { useTheme } from '../composables/useTheme';
import IconButton from './IconButton.vue';

/** Light/dark switch. The icon shows the theme you switch to. */
const { isDark, toggle, toggleLabel } = useTheme();
</script>

<template>
    <IconButton :icon="isDark ? 'sun' : 'moon'" :label="toggleLabel" :aria-pressed="isDark" @click="toggle" />
</template>
