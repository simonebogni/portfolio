<script setup lang="ts">
import type { FilterOption } from '@core/features/portfolio-filter';
import { BaseIcon } from '@designs/terrain/shared/ui';

/**
 * Toggle buttons that pick one category (single choice, with aria-pressed).
 * v-model holds the selected option value. Announce the result count with a
 * polite live region next to the results (see filterStatus).
 */
defineProps<{
    options: FilterOption[];
    label: string;
}>();

const model = defineModel<string>({ required: true });
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
