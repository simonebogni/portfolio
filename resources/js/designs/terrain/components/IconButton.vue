<script setup>
import { computed } from 'vue';

/**
 * Round 48px control holding an icon. A <button> by default, an <a> when given an href.
 * The label is required: it is the accessible name of an icon-only control.
 */
const props = defineProps({
    label: { type: String, required: true },
    href: { type: String, default: null },
});

const isExternal = computed(() => /^https?:\/\//.test(props.href ?? ''));
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
        <slot />
    </a>
    <button v-else class="icon-btn" type="button" :aria-label="label">
        <slot />
    </button>
</template>
