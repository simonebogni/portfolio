<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppIcon from './AppIcon.vue';

/**
 * Call-to-action link styled as a button. Internal paths ("/…") use Inertia
 * navigation; anything else (https:, mailto:) is a plain anchor.
 */
const props = defineProps({
    href: { type: String, required: true },
    variant: { type: String, default: 'primary', validator: (value) => ['primary', 'ghost'].includes(value) },
    icon: { type: String, default: null },
});

const internal = computed(() => props.href.startsWith('/') && !props.href.startsWith('//'));
</script>

<template>
    <component :is="internal ? Link : 'a'" :href="href" class="btn" :class="`btn--${variant}`">
        <slot />
        <AppIcon v-if="icon" :name="icon" :size="18" class="btn__icon btn__icon--trailing" />
    </component>
</template>
