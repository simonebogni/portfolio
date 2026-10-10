<script setup lang="ts">
import { useTheme } from '@core/features/theme';
import { BpIcon } from '@designs/blueprint/shared/ui';

/** Light/dark switch. The icon shows the theme you switch to. */
const { isDark, toggle, toggleLabel } = useTheme();
</script>

<template>
    <button class="icon-button" type="button" :aria-pressed="isDark" :aria-label="toggleLabel" @click="toggle">
        <BpIcon :name="isDark ? 'sun' : 'moon'" />
    </button>
</template>
