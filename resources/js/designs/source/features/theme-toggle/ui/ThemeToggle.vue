<script setup lang="ts">
import { useTheme } from '@core/features/theme';
import { IconButton } from '@designs/source/shared/ui';

/** Light/dark switch. The icon shows the theme you switch to. */
const { isDark, toggle, toggleLabel } = useTheme();
</script>

<template>
    <IconButton :icon="isDark ? 'sun' : 'moon'" :label="toggleLabel" :aria-pressed="isDark" @click="toggle" />
</template>
