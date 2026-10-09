<script setup>
import PillButton from './PillButton.vue';

/**
 * A set of toggle buttons where one option is active (aria-pressed).
 * Pair it with a polite live region that announces the result.
 */
defineProps({
    options: { type: Array, required: true },
    modelValue: { type: [String, Number], required: true },
    label: { type: String, required: true },
    controls: { type: String, default: undefined },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="filter-group" role="group" :aria-label="label">
        <ul class="filter-group__list">
            <li v-for="option in options" :key="option.value">
                <PillButton
                    class="filter-group__button"
                    :pressed="option.value === modelValue"
                    :aria-controls="controls"
                    @click="emit('update:modelValue', option.value)"
                >
                    {{ option.label }}
                </PillButton>
            </li>
        </ul>
    </div>
</template>
