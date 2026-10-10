<script setup>
/** Outlined uppercase chips, e.g. the technologies of a role or project. */
defineProps({
    tags: { type: Array, required: true },
    label: { type: String, default: 'Technologies' },
});
</script>

<template>
    <ul v-if="tags.length" class="tag-list plain-list" :aria-label="label">
        <li v-for="tag in tags" :key="tag" class="tag">{{ tag }}</li>
    </ul>
</template>
