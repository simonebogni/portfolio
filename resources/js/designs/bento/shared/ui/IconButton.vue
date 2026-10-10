<script setup lang="ts">
import { computed } from 'vue';
import Icon from './Icon.vue';
import type { IconName } from './icons';

/**
 * Round 44×44 icon-only control. Renders a link when `href` is set, otherwise a button.
 * `label` is the accessible name (required: the icon itself is hidden).
 * `pressed` and `expanded` are left out of the markup unless they are passed.
 */
const props = withDefaults(
    defineProps<{
        icon: IconName;
        label: string;
        href?: string | null;
        pressed?: boolean;
        expanded?: boolean;
        controls?: string;
    }>(),
    { href: null, pressed: undefined, expanded: undefined, controls: undefined },
);

/** Case-sensitive on purpose: the same test as before the move (core's isExternal ignores case). */
const isExternal = computed(() => Boolean(props.href) && /^https?:\/\//.test(props.href ?? ''));
</script>

<template>
    <a
        v-if="href"
        class="icon-btn"
        :href="href"
        :target="isExternal ? '_blank' : undefined"
        :rel="isExternal ? 'noopener noreferrer' : undefined"
        :aria-label="isExternal ? `${label} (opens in a new tab)` : label"
    >
        <Icon :name="icon" />
    </a>
    <button
        v-else
        class="icon-btn"
        type="button"
        :aria-label="label"
        :aria-pressed="pressed"
        :aria-expanded="expanded"
        :aria-controls="controls"
    >
        <Icon :name="icon" />
    </button>
</template>
