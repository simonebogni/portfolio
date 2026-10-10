<script setup lang="ts">
import BpIcon from './BpIcon.vue';
import type { FilterChoice } from './types';

/**
 * Single-choice filter as toggle buttons (aria-pressed). The pressed one also
 * shows a check icon, so the state never relies on colour alone. Use with v-model.
 */
defineProps<{
    options: readonly FilterChoice[];
    label: string;
}>();

const model = defineModel<string>({ required: true });
</script>

<template>
    <div class="filters" role="group" :aria-label="label">
        <button
            v-for="option in options"
            :key="option.value"
            class="filter"
            type="button"
            :aria-pressed="model === option.value"
            @click="model = option.value"
        >
            <BpIcon v-if="model === option.value" name="check" :size="16" />
            {{ option.label }}
        </button>
    </div>
</template>
