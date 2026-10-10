<script setup>
import BaseIcon from './BaseIcon.vue';

/**
 * Toggle buttons that pick one category (single choice, with aria-pressed).
 * v-model holds the selected option value. Announce the result count with a
 * polite live region next to the results (see pages/Portfolio.vue).
 */
defineProps({
    options: { type: Array, required: true }, // [{ value, label, count }]
    label: { type: String, required: true },
});

const model = defineModel({ type: String, required: true });
</script>

<template>
    <div class="filters" role="group" :aria-label="label">
        <ul class="filters__list plain-list">
            <li v-for="option in options" :key="option.value">
                <button
                    type="button"
                    class="filter"
                    :aria-pressed="model === option.value ? 'true' : 'false'"
                    @click="model = option.value"
                >
                    <BaseIcon v-if="model === option.value" name="check" :size="16" />
                    {{ option.label }}
                    <span class="filter__count">({{ option.count }})</span>
                </button>
            </li>
        </ul>
    </div>
</template>
