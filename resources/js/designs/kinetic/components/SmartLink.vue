<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { isExternal } from '../lib/format';

/**
 * One link component for the whole site: internal paths go through Inertia,
 * http(s) links open in a new tab and say so to screen readers, and mailto:
 * links stay plain anchors.
 */
const props = defineProps({
    href: { type: String, required: true },
});

const external = computed(() => isExternal(props.href));
const internal = computed(() => props.href.startsWith('/'));
</script>

<template>
    <Link v-if="internal" :href="href"><slot /></Link>
    <a v-else-if="external" :href="href" target="_blank" rel="noopener noreferrer"><slot /><span class="visually-hidden"> (opens in a new tab)</span></a>
    <a v-else :href="href"><slot /></a>
</template>
