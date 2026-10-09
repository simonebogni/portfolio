<script setup>
import { toRoman } from '../lib/copy';

/** Three (or more) side-by-side columns with roman counters: "The engineer / The lead / The partner". */
defineProps({
    items: { type: Array, required: true },
});
</script>

<template>
    <ul class="pillar-list">
        <li v-for="(item, index) in items" :key="item.title" class="pillar-list__item">
            <span class="pillar-list__counter" aria-hidden="true">{{ toRoman(index + 1) }}.</span>
            <h3 class="pillar-list__title">{{ item.title }}</h3>
            <p class="pillar-list__text">{{ item.text }}</p>
        </li>
    </ul>
</template>
