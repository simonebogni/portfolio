<script setup lang="ts">
import { isExternal } from '@core/shared/lib';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * One link component for the whole site: internal paths go through Inertia,
 * http(s) links open in a new tab and say so to screen readers, and mailto:
 * links stay plain anchors.
 */
const props = defineProps<{
    href: string;
}>();

const external = computed(() => isExternal(props.href));
const internal = computed(() => props.href.startsWith('/'));
</script>

<template>
    <Link v-if="internal" :href="href"><slot></slot></Link>
    <a v-else-if="external" :href="href" target="_blank" rel="noopener noreferrer"><slot></slot><span class="visually-hidden"> (opens in a new tab)</span></a>
    <a v-else :href="href"><slot></slot></a>
</template>
