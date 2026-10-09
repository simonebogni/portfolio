<script setup>
import { computed } from 'vue';
import { emphasisParts } from '../lib/format';

/** Renders text where *starred* words are set in the accent italic, without v-html. */
const props = defineProps({
    text: { type: String, required: true },
});

const parts = computed(() => emphasisParts(props.text));
</script>

<template>
    <template v-for="(part, index) in parts" :key="index">
        <em v-if="part.em" class="accent-em">{{ part.text }}</em>
        <template v-else>{{ part.text }}</template>
    </template>
</template>
