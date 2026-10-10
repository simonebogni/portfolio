<script setup lang="ts">
import AppIcon from '../icon/AppIcon.vue';
import type { IconName } from '../icon/icons';

/**
 * Square 44×44 control showing one icon. `label` is the accessible name.
 * Renders a link when `href` is set, otherwise a button; other attributes
 * (aria-pressed, aria-expanded, @click…) pass through.
 */
withDefaults(defineProps<{ icon: IconName; label: string; href?: string | null }>(), { href: null });
</script>

<template>
    <a v-if="href" class="icon-btn" :href="href" :aria-label="label">
        <AppIcon :name="icon" />
    </a>
    <button v-else class="icon-btn" type="button" :aria-label="label">
        <AppIcon :name="icon" />
    </button>
</template>
