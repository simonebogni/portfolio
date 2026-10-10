<script setup lang="ts">
import { useTheme } from '@core/features/theme';
import { BaseIcon, IconButton } from '@designs/terrain/shared/ui';

/**
 * Light/dark switch. aria-pressed reports whether the dark theme is on; the icon
 * is swapped with CSS tokens so the server-rendered HTML is right before hydration.
 */
const { isDark, toggle } = useTheme();
</script>

<template>
    <IconButton label="Dark theme" :aria-pressed="isDark ? 'true' : 'false'" title="Toggle dark theme" @click="toggle">
        <BaseIcon class="theme-icon theme-icon--light" name="sun" />
        <BaseIcon class="theme-icon theme-icon--dark" name="moon" />
    </IconButton>
</template>
