<script setup>
import BpIcon from './BpIcon.vue';

/**
 * Single-choice filter as toggle buttons (aria-pressed). The pressed one also
 * shows a check icon, so the state never relies on colour alone.
 * Options: { value, label }. Use with v-model.
 */
defineProps({
    options: { type: Array, required: true },
    label: { type: String, required: true },
});

const model = defineModel({ type: String, required: true });
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
