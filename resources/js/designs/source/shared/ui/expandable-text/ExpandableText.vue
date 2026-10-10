<script setup lang="ts">
import { computed, ref, useId } from 'vue';

/**
 * Paragraph clamped to `lines` lines when longer than `clampFrom` characters,
 * with a "Show more" toggle (aria-expanded). Screen readers always get the
 * full text; `context` completes the toggle's accessible name.
 */
const props = withDefaults(defineProps<{ text: string; clampFrom?: number; lines?: number; context?: string | null }>(), {
    clampFrom: 220,
    lines: 4,
    context: null,
});

const id = useId();
const expanded = ref(false);
const long = computed(() => props.text.length > props.clampFrom);
</script>

<template>
    <div class="expandable">
        <p :id="id" class="expandable__text" :class="{ 'is-clamped': long && !expanded }" :style="{ '--clamp-lines': lines }">{{ text.trim() }}</p>
        <button v-if="long" class="more-toggle" type="button" :aria-expanded="expanded ? 'true' : 'false'" :aria-controls="id" @click="expanded = !expanded">
            {{ expanded ? 'Show less' : 'Show more' }}<span v-if="context" class="visually-hidden"> about {{ context }}</span>
        </button>
    </div>
</template>
