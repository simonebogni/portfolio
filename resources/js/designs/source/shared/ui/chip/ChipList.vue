<script setup lang="ts">
/** A list of technology tags. `label` names the list for screen readers. */
withDefaults(defineProps<{ items: readonly string[]; label?: string }>(), { label: 'Technologies' });
</script>

<template>
    <ul v-if="items.length" class="chips" :aria-label="label">
        <li v-for="item in items" :key="item" class="chip">{{ item }}</li>
    </ul>
</template>
