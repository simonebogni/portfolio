<script setup>
import { useTheme } from '../composables/useTheme';
import PillButton from './PillButton.vue';

/** Light/dark switch. The choice is remembered by useTheme (localStorage). */
const { isDark, toggle } = useTheme();
</script>

<template>
    <PillButton class="theme-toggle" :pressed="isDark" aria-label="Dark theme" @click="toggle">
        <svg v-if="isDark" class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z" fill="currentColor" />
        </svg>
        <svg v-else class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z" />
        </svg>
        <span aria-hidden="true">Dark</span>
    </PillButton>
</template>
