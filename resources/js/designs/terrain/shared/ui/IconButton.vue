<script setup lang="ts">
import { computed } from 'vue';
import { isHttpUrl } from '../lib';

/**
 * Round 48px control holding an icon. A <button> by default, an <a> when given an href.
 * The label is required: it is the accessible name of an icon-only control.
 */
const props = withDefaults(
    defineProps<{
        label: string;
        href?: string | null;
    }>(),
    { href: null },
);

const isExternal = computed(() => isHttpUrl(props.href));
</script>

<template>
    <a
        v-if="href"
        class="icon-btn"
        :href="href"
        :aria-label="isExternal ? `${label} (opens in a new tab)` : label"
        :target="isExternal ? '_blank' : undefined"
        :rel="isExternal ? 'noopener noreferrer' : undefined"
    >
        <slot></slot>
    </a>
    <button v-else class="icon-btn" type="button" :aria-label="label">
        <slot></slot>
    </button>
</template>
