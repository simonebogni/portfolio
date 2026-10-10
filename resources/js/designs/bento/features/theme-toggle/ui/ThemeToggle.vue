<script setup lang="ts">
import { useTheme } from '@core/features/theme';
import { IconButton } from '@designs/bento/shared/ui';

/** Light/dark switch: a toggle button (aria-pressed = dark theme on), remembered in localStorage. */
const { isDark, toggle } = useTheme();
</script>

<template>
    <IconButton :icon="isDark ? 'sun' : 'moon'" label="Dark theme" :pressed="isDark" @click="toggle" />
</template>
