<script setup>
/**
 * Numbered section title: a decorative serif numeral and the heading.
 * The numeral is hidden from assistive technology; the heading carries the id
 * that the section's aria-labelledby points to.
 */
defineProps({
    id: { type: String, required: true },
    title: { type: String, required: true },
    numeral: { type: String, default: '' },
    level: { type: Number, default: 2 },
    compact: { type: Boolean, default: false },
});
</script>

<template>
    <div class="section-heading" :class="{ 'section-heading--compact': compact }">
        <span v-if="numeral" class="section-heading__numeral" aria-hidden="true">{{ numeral }}.</span>
        <component :is="`h${level}`" :id="id" class="section-heading__title">{{ title }}</component>
    </div>
</template>
