<script setup>
/**
 * Single-choice filter: a group of toggle buttons with aria-pressed, plus a
 * polite live region that announces how many results are shown.
 * The pressed button gets a square marker as well as the orange fill, so the
 * state does not depend on colour.
 */
defineProps({
    options: { type: Array, required: true }, // [{ value, label, count }]
    label: { type: String, required: true },
    status: { type: String, required: true },
});

const model = defineModel({ type: [String, Number], required: true });
</script>

<template>
    <div class="filter-group">
        <ul class="filter-group__list plain-list" role="group" :aria-label="label">
            <li v-for="option in options" :key="option.value">
                <button class="filter-group__button" type="button" :aria-pressed="model === option.value" @click="model = option.value">
                    {{ option.label }}<span class="filter-group__count"><span aria-hidden="true"> · </span><span class="visually-hidden">, </span>{{ option.count }}<span class="visually-hidden"> projects</span></span>
                </button>
            </li>
        </ul>
        <p class="filter-group__status" role="status" aria-live="polite">{{ status }}</p>
    </div>
</template>
