<script setup>
import Icon from './Icon.vue';

/**
 * Category filter: a group of toggle buttons (aria-pressed), one per option.
 * The pressed button also shows a check mark, so the state never depends on colour alone.
 */
defineProps({
    options: { type: Array, required: true }, // [{ value, label, count }]
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
            <Icon v-if="model === option.value" name="check" :size="16" />
            {{ option.label }}<span class="filter__count" aria-hidden="true">&nbsp;· {{ option.count }}</span>
            <span class="visually-hidden">({{ option.count }} {{ option.count === 1 ? 'project' : 'projects' }})</span>
        </button>
    </div>
</template>
