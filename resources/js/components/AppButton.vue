<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { isExternal } from '../lib/profile';
import BpIcon from './BpIcon.vue';

/**
 * Button-styled link. Internal paths use Inertia's <Link>; http(s) links open
 * in a new tab and say so to screen readers; mailto: links stay plain <a>.
 */
const props = defineProps({
    href: { type: String, required: true },
    variant: { type: String, default: 'primary' }, // primary | ghost
});

const external = computed(() => isExternal(props.href));
const internal = computed(() => props.href.startsWith('/'));
</script>

<template>
    <Link v-if="internal" :href="href" class="btn" :class="`btn--${variant}`"><slot /></Link>
    <a
        v-else
        :href="href"
        class="btn"
        :class="`btn--${variant}`"
        :target="external ? '_blank' : undefined"
        :rel="external ? 'noopener noreferrer' : undefined"
    >
        <slot />
        <template v-if="external">
            <BpIcon name="external" :size="18" />
            <span class="visually-hidden"> (opens in a new tab)</span>
        </template>
    </a>
</template>
