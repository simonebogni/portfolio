<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseIcon from './BaseIcon.vue';

/**
 * Pill-shaped call to action. Renders an Inertia <Link> for internal paths,
 * an <a> for external/mailto URLs, and a <button> when there is no href.
 */
const props = defineProps({
    href: { type: String, default: null },
    variant: { type: String, default: 'primary', validator: (value) => ['primary', 'ghost'].includes(value) },
    /** Icon shown after the label (see BaseIcon). External links get the "external" icon automatically. */
    icon: { type: String, default: null },
    /** Stretch to the full width of the container on small screens. */
    block: { type: Boolean, default: false },
});

const isInternal = computed(() => props.href?.startsWith('/') && !props.href.startsWith('//'));
const isExternal = computed(() => /^https?:\/\//.test(props.href ?? ''));
const tag = computed(() => {
    if (!props.href) {
        return 'button';
    }

    return isInternal.value ? Link : 'a';
});
const trailingIcon = computed(() => props.icon ?? (isExternal.value ? 'external' : null));
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
        <slot />
        <span v-if="isExternal" class="visually-hidden"> (opens in a new tab)</span>
        <BaseIcon v-if="trailingIcon" :name="trailingIcon" :size="18" />
    </component>
</template>
