<script setup>
/**
 * Row of toggle buttons that filter a collection. Exactly one option is pressed
 * (aria-pressed). Pair it with a polite live region that announces the result.
 *
 * options: [{ value, label, count }]
 */
defineProps({
    options: { type: Array, required: true },
    label: { type: String, required: true },
});

const model = defineModel({ type: [String, Number], required: true });
</script>

<template>
    <div class="filter-bar" role="group" :aria-label="label">
        <ul class="filter-bar__list">
            <li v-for="option in options" :key="option.value">
                <button
                    class="filter-bar__button"
                    type="button"
                    :aria-pressed="model === option.value ? 'true' : 'false'"
                    @click="model = option.value"
                >
                    {{ option.label }} <span class="filter-bar__count">({{ option.count }})</span>
                </button>
            </li>
        </ul>
    </div>
</template>
