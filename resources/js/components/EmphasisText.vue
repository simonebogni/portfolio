<script setup>
import { computed } from 'vue';
import { splitEmphasis } from '../lib/copy';

/** Renders copy where *starred* words are shown in the accent italic. */
const props = defineProps({
    text: { type: String, required: true },
});

const segments = computed(() => splitEmphasis(props.text));
</script>

<template>
    <template v-for="(segment, index) in segments" :key="index">
        <em v-if="segment.em" class="emphasis">{{ segment.text }}</em>
        <template v-else>{{ segment.text }}</template>
    </template>
</template>
