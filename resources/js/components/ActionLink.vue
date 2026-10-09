<script setup>
import { Link } from '@inertiajs/vue3';

/**
 * A link styled as an action.
 * - variant "solid": inverse block button, for the main action of a section (48px tall).
 * - variant "underline": bold text with an accent underline (44px target).
 * Internal links use Inertia's <Link>; set `external` for other sites.
 */
defineProps({
    href: { type: String, required: true },
    variant: { type: String, default: 'underline', validator: (value) => ['solid', 'underline'].includes(value) },
    external: { type: Boolean, default: false },
    arrow: { type: Boolean, default: false },
});
</script>

<template>
    <a v-if="external" :href="href" class="action-link" :class="`action-link--${variant}`" rel="noopener">
        <slot /><span v-if="arrow" class="action-link__arrow" aria-hidden="true">↗</span>
    </a>
    <Link v-else :href="href" class="action-link" :class="`action-link--${variant}`">
        <slot /><span v-if="arrow" class="action-link__arrow" aria-hidden="true">→</span>
    </Link>
</template>
