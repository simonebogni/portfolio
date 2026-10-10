<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * Pill-shaped call to action. Internal paths render an Inertia <Link>,
 * external URLs (including protocol-relative ones) an <a> that announces it opens a new tab,
 * and no href a <button>.
 */
const props = withDefaults(
    defineProps<{
        href?: string | null;
        variant?: 'primary' | 'ghost' | 'on-accent';
        type?: 'button' | 'submit' | 'reset';
    }>(),
    { href: null, variant: 'primary', type: 'button' },
);

const isExternal = computed(() => Boolean(props.href) && /^(https?:)?\/\//.test(props.href ?? ''));
const isInternal = computed(() => Boolean(props.href) && (props.href ?? '').startsWith('/') && !isExternal.value);
</script>

<template>
    <Link v-if="isInternal && href" :href="href" class="btn" :class="`btn--${variant}`"><slot></slot></Link>
    <a
        v-else-if="href"
        :href="href"
        class="btn"
        :class="`btn--${variant}`"
        :target="isExternal ? '_blank' : undefined"
        :rel="isExternal ? 'noopener noreferrer' : undefined"
    >
        <slot></slot><span v-if="isExternal" class="visually-hidden"> (opens in a new tab)</span>
    </a>
    <button v-else :type="type" class="btn" :class="`btn--${variant}`"><slot></slot></button>
</template>
