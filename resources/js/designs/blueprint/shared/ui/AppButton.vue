<script setup lang="ts">
import { isExternal } from '@core/shared/lib';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import BpIcon from './BpIcon.vue';

/**
 * Button-styled link. Internal paths use Inertia's <Link>; http(s) links open
 * in a new tab and say so to screen readers; mailto: links stay plain <a>.
 */
const props = withDefaults(
    defineProps<{
        href: string;
        variant?: 'primary' | 'ghost';
    }>(),
    { variant: 'primary' },
);

const external = computed(() => isExternal(props.href));
const internal = computed(() => props.href.startsWith('/'));
</script>

<template>
    <Link v-if="internal" :href="href" class="btn" :class="`btn--${variant}`"><slot></slot></Link>
    <a
        v-else
        :href="href"
        class="btn"
        :class="`btn--${variant}`"
        :target="external ? '_blank' : undefined"
        :rel="external ? 'noopener noreferrer' : undefined"
    >
        <slot></slot>
        <template v-if="external">
            <BpIcon name="external" :size="18" />
            <span class="visually-hidden"> (opens in a new tab)</span>
        </template>
    </a>
</template>
