<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { isInternal } from '../../lib';
import AppIcon from '../icon/AppIcon.vue';
import type { IconName } from '../icon/icons';

/**
 * Call-to-action link styled as a button. Internal paths ("/…") use Inertia
 * navigation; anything else (https:, mailto:) is a plain anchor.
 */
const props = withDefaults(defineProps<{ href: string; variant?: 'primary' | 'ghost'; icon?: IconName | null }>(), {
    variant: 'primary',
    icon: null,
});

const internal = computed(() => isInternal(props.href));
</script>

<template>
    <component :is="internal ? Link : 'a'" :href="href" class="btn" :class="`btn--${variant}`">
        <slot></slot>
        <AppIcon v-if="icon" :name="icon" :size="18" class="btn__icon btn__icon--trailing" />
    </component>
</template>
