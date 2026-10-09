<script setup>
import AppIcon from './AppIcon.vue';

/**
 * Category filter: a group of toggle buttons (aria-pressed), one pressed at a
 * time, used with v-model. `options` = [{ value, label, count }].
 */
const model = defineModel({ type: String, required: true });

defineProps({
    options: { type: Array, required: true },
    label: { type: String, default: 'Filter by category' },
});
</script>

<template>
    <div class="filter" role="group" :aria-label="label">
        <ul class="filter__list">
            <li v-for="option in options" :key="option.value">
                <button
                    class="filter__button"
                    type="button"
                    :aria-pressed="model === option.value ? 'true' : 'false'"
                    @click="model = option.value"
                >
                    <AppIcon name="check" :size="16" class="filter__check" />
                    {{ option.label }}
                    <span class="filter__count"><span class="visually-hidden">(</span>{{ option.count }}<span class="visually-hidden"> projects)</span></span>
                </button>
            </li>
        </ul>
    </div>
</template>
