<script setup>
import { computed } from 'vue';
import { isExternal } from '../lib/format';
import SmartLink from './SmartLink.vue';

/**
 * Square, uppercase button. Renders a link when `href` is set, a <button> otherwise.
 * Variants: accent (orange fill), inverse (text-colour fill), outline (2px border only).
 * Sizes: m (44px, secondary actions) and l (56px, calls to action).
 */
const props = defineProps({
    href: { type: String, default: null },
    variant: { type: String, default: 'accent', validator: (v) => ['accent', 'inverse', 'outline'].includes(v) },
    size: { type: String, default: 'l', validator: (v) => ['m', 'l'].includes(v) },
    block: { type: Boolean, default: false },
    type: { type: String, default: 'button' },
});

const classes = computed(() => ['button', `button--${props.variant}`, `button--${props.size}`, { 'button--block': props.block }]);
const arrow = computed(() => (props.href && isExternal(props.href) ? '↗' : '→'));
</script>

<template>
    <SmartLink v-if="href" :href="href" :class="classes">
        <slot /><span class="button__arrow" aria-hidden="true">{{ arrow }}</span>
    </SmartLink>
    <button v-else :type="type" :class="classes"><slot /></button>
</template>
