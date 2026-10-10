<script setup lang="ts">
import { isExternal } from '@core/shared/lib';
import { computed } from 'vue';
import SmartLink from './SmartLink.vue';

/**
 * Square, uppercase button. Renders a link when `href` is set, a <button> otherwise.
 * Variants: accent (orange fill), inverse (text-colour fill), outline (2px border only).
 * Sizes: m (44px, secondary actions) and l (56px, calls to action).
 */
const props = withDefaults(
    defineProps<{
        href?: string | null;
        variant?: 'accent' | 'inverse' | 'outline';
        size?: 'm' | 'l';
        block?: boolean;
        type?: 'button' | 'submit' | 'reset';
    }>(),
    { href: null, variant: 'accent', size: 'l', block: false, type: 'button' },
);

const classes = computed(() => ['button', `button--${props.variant}`, `button--${props.size}`, { 'button--block': props.block }]);
const arrow = computed(() => (props.href && isExternal(props.href) ? '↗' : '→'));
</script>

<template>
    <SmartLink v-if="href" :href="href" :class="classes">
        <slot></slot><span class="button__arrow" aria-hidden="true">{{ arrow }}</span>
    </SmartLink>
    <button v-else :type="type" :class="classes"><slot></slot></button>
</template>
