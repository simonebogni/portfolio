<script setup>
import { computed } from 'vue';
import Icon from './Icon.vue';

/**
 * Round 44×44 icon-only control. Renders a link when `href` is set, otherwise a button.
 * `label` is the accessible name (required: the icon itself is hidden).
 */
const props = defineProps({
    icon: { type: String, required: true },
    label: { type: String, required: true },
    href: { type: String, default: null },
    pressed: { type: Boolean, default: undefined },
    expanded: { type: Boolean, default: undefined },
    controls: { type: String, default: undefined },
});

const isExternal = computed(() => Boolean(props.href) && /^https?:\/\//.test(props.href));
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
