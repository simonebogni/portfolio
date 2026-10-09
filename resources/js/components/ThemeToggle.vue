<script setup>
import { useTheme } from '../composables/useTheme';
import IconButton from './IconButton.vue';

/** Light/dark switch: a toggle button (aria-pressed = dark theme on), remembered in localStorage. */
const { isDark, toggle } = useTheme();
</script>

<template>
    <IconButton :icon="isDark ? 'sun' : 'moon'" label="Dark theme" :pressed="isDark" @click="toggle" />
</template>
