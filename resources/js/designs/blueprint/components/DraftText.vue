<script setup>
import { computed } from 'vue';
import { isPlaceholder } from '../lib/profile';

/**
 * Text from config/profile.php. Placeholders such as "[CURRENT COMPANY]"
 * render in a visibly draft style so the owner spots them.
 */
const props = defineProps({
    text: { type: [String, Number], default: '' },
    as: { type: String, default: 'span' },
});

const draft = computed(() => isPlaceholder(props.text));
</script>

<template>
    <component :is="as" :class="{ 'is-placeholder': draft }">{{ text }}</component>
</template>
