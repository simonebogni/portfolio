<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { isHttpUrl, isSitePath } from '../lib';
import BaseIcon from './BaseIcon.vue';
import type { IconName } from './icons';

/**
 * Pill-shaped call to action. Renders an Inertia <Link> for internal paths,
 * an <a> for external/mailto URLs, and a <button> when there is no href.
 */
const props = withDefaults(
    defineProps<{
        href?: string | null;
        variant?: 'primary' | 'ghost';
        /** Icon shown after the label (see BaseIcon). External links get the "external" icon automatically. */
        icon?: IconName | null;
        /** Stretch to the full width of the container on small screens. */
        block?: boolean;
    }>(),
    { href: null, variant: 'primary', icon: null, block: false },
);

const isExternal = computed(() => isHttpUrl(props.href));
const tag = computed(() => {
    if (!props.href) {
        return 'button';
    }

    return isSitePath(props.href) ? Link : 'a';
});
const trailingIcon = computed<IconName | null>(() => props.icon ?? (isExternal.value ? 'external' : null));
</script>

<template>
    <component
        :is="tag"
        class="btn"
        :class="[`btn--${variant}`, { 'btn--block': block }]"
        :href="href ?? undefined"
        :type="href ? undefined : 'button'"
        :target="isExternal ? '_blank' : undefined"
        :rel="isExternal ? 'noopener noreferrer' : undefined"
    >
        <slot></slot>
        <span v-if="isExternal" class="visually-hidden"> (opens in a new tab)</span>
        <BaseIcon v-if="trailingIcon" :name="trailingIcon" :size="18" />
    </component>
</template>
