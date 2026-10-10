<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { isExternal } from '../lib/profile';
import BpIcon from './BpIcon.vue';

/**
 * Accent text link with an arrow ("Read more →", "Source ↗"). `context` is
 * read only by screen readers, to make repeated link texts unique.
 */
const props = defineProps({
    href: { type: String, required: true },
    context: { type: String, default: '' },
});

const external = computed(() => isExternal(props.href));
</script>

<template>
    <a
        v-if="external"
        class="text-link"
        :href="href"
        target="_blank"
        rel="noopener noreferrer"
    >
        <slot /><span v-if="context" class="visually-hidden">: {{ context }}</span>
        <BpIcon name="external" :size="18" />
        <span class="visually-hidden"> (opens in a new tab)</span>
    </a>
    <Link v-else class="text-link" :href="href">
        <slot /><span v-if="context" class="visually-hidden">: {{ context }}</span>
        <BpIcon name="arrow" :size="18" />
    </Link>
</template>
