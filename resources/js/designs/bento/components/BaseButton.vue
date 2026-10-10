<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * Pill-shaped call to action. Internal paths render an Inertia <Link>,
 * external URLs an <a> that announces it opens a new tab, and no href a <button>.
 */
const props = defineProps({
    href: { type: String, default: null },
    variant: { type: String, default: 'primary', validator: (value) => ['primary', 'ghost', 'on-accent'].includes(value) },
    type: { type: String, default: 'button' },
});

const isExternal = computed(() => Boolean(props.href) && /^(https?:)?\/\//.test(props.href));
const isInternal = computed(() => Boolean(props.href) && props.href.startsWith('/') && !isExternal.value);
</script>

<template>
    <Link v-if="isInternal" :href="href" class="btn" :class="`btn--${variant}`"><slot /></Link>
    <a
        v-else-if="href"
        :href="href"
        class="btn"
        :class="`btn--${variant}`"
        :target="isExternal ? '_blank' : undefined"
        :rel="isExternal ? 'noopener noreferrer' : undefined"
    >
        <slot /><span v-if="isExternal" class="visually-hidden"> (opens in a new tab)</span>
    </a>
    <button v-else :type="type" class="btn" :class="`btn--${variant}`"><slot /></button>
</template>
