<script setup lang="ts">
import { ref } from 'vue';

/**
 * Orange band of words that scrolls sideways. The words repeat content found
 * elsewhere on the page, so the band is hidden from assistive technology. It
 * stops under prefers-reduced-motion, and the pause button stops it for
 * everyone else (WCAG 2.2.2).
 */
defineProps<{
    items: readonly string[];
}>();

const paused = ref(false);
</script>

<template>
    <div class="ticker" :class="{ 'is-paused': paused }" :style="{ '--ticker-items': items.length }">
        <div class="ticker__viewport" aria-hidden="true">
            <div class="ticker__track">
                <p v-for="copy in 2" :key="copy" class="ticker__line">
                    <template v-for="item in items" :key="item"><span>{{ item }}</span><b>✦</b></template>
                </p>
            </div>
        </div>
        <button class="ticker__control" type="button" :aria-pressed="paused" @click="paused = !paused">
            <span aria-hidden="true">{{ paused ? '▶' : '❚❚' }}</span>
            <span class="visually-hidden">Pause the scrolling band</span>
        </button>
    </div>
</template>
