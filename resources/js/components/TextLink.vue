<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * Small mono link for secondary actions. `context` is read by screen readers
 * only, to tell apart several "View certificate" links on one page.
 */
const props = defineProps({
    href: { type: String, required: true },
    context: { type: String, default: null },
});

const internal = computed(() => props.href.startsWith('/') && !props.href.startsWith('//'));
</script>

<template>
    <component :is="internal ? Link : 'a'" :href="href" class="text-link">
        <slot /><span v-if="context" class="visually-hidden">: {{ context }}</span>
    </component>
</template>
