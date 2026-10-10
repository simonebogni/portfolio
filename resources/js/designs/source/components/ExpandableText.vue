<script setup>
import { computed, ref, useId } from 'vue';

/**
 * Paragraph clamped to `lines` lines when longer than `clampFrom` characters,
 * with a "Show more" toggle (aria-expanded). Screen readers always get the
 * full text; `context` completes the toggle's accessible name.
 */
const props = defineProps({
    text: { type: String, required: true },
    clampFrom: { type: Number, default: 220 },
    lines: { type: Number, default: 4 },
    context: { type: String, default: null },
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
