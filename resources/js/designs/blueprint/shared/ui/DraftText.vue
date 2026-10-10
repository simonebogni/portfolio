<script setup lang="ts">
import { isPlaceholder } from '@core/shared/lib';
import { computed } from 'vue';

/**
 * Text from config/profile.php. Placeholders such as "[CURRENT COMPANY]"
 * render in a visibly draft style so the owner spots them.
 */
const props = withDefaults(
    defineProps<{
        text?: string | number;
        as?: string;
    }>(),
    { text: '', as: 'span' },
);

const draft = computed(() => isPlaceholder(props.text));
</script>

<template>
    <component :is="as" :class="{ 'is-placeholder': draft }">{{ text }}</component>
</template>
