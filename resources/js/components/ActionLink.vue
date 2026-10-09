<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * A link styled as an action.
 * - solid: dark pill (the primary call to action)
 * - inverse: light pill, for dark bands
 * - text: underlined link with an accent underline
 * Internal paths ("/portfolio") use Inertia's <Link>, everything else a plain <a>.
 */
const props = defineProps({
    href: { type: String, required: true },
    variant: { type: String, default: 'solid', validator: (value) => ['solid', 'inverse', 'text'].includes(value) },
});

const internal = computed(() => props.href.startsWith('/') && !props.href.startsWith('//'));
const classes = computed(() => (props.variant === 'text' ? 'text-link' : ['button', `button--${props.variant}`]));
</script>

<template>
    <Link v-if="internal" :href="href" :class="classes"><slot /></Link>
    <a v-else :href="href" :class="classes"><slot /></a>
</template>
