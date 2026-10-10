<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { isInternal } from '../../lib';

/**
 * Small mono link for secondary actions. `context` is read by screen readers
 * only, to tell apart several "View certificate" links on one page.
 */
const props = withDefaults(defineProps<{ href: string; context?: string | null }>(), { context: null });

const internal = computed(() => isInternal(props.href));
</script>

<template>
    <component :is="internal ? Link : 'a'" :href="href" class="text-link">
        <slot></slot><span v-if="context" class="visually-hidden">: {{ context }}</span>
    </component>
</template>
