<script setup lang="ts">
import type { FilterOption } from '@core/features/portfolio-filter';
import { Icon } from '@designs/bento/shared/ui';

/**
 * Category filter: a group of toggle buttons (aria-pressed), one per option.
 * The pressed button also shows a check mark, so the state never depends on colour alone.
 */
defineProps<{ options: FilterOption[]; label: string }>();

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
            <Icon v-if="model === option.value" name="check" :size="16" />
            {{ option.label }}<span class="filter__count" aria-hidden="true">&nbsp;· {{ option.count }}</span>
            <span class="visually-hidden">({{ option.count }} {{ option.count === 1 ? 'project' : 'projects' }})</span>
        </button>
    </div>
</template>
