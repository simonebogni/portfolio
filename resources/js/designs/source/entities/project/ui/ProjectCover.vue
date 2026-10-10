<script setup lang="ts">
import { computed } from 'vue';
import { monogram } from '../model/monogram';

/**
 * Decorative cover for a project. Draws a monogram (or an abstract UI sketch
 * with `mock`) and lays the screenshot on top when it loads, so a missing
 * image never shows as broken.
 */
const props = withDefaults(defineProps<{ title: string; imageUrl?: string | null; mock?: boolean }>(), { imageUrl: null });

const letters = computed(() => monogram(props.title));

const imageStyle = computed(() => (props.imageUrl ? { backgroundImage: `url("${props.imageUrl.replace(/["\\\n]/g, '')}")` } : null));
</script>

<template>
    <div class="cover" aria-hidden="true">
        <div v-if="mock" class="cover__mock">
            <i class="cover__mock-accent"></i>
            <i style="width: 70%"></i>
            <div class="cover__mock-row"><i></i><i></i><i></i></div>
            <i style="width: 55%"></i>
            <i style="width: 85%"></i>
        </div>
        <span v-else class="cover__monogram">{{ letters }}</span>
        <div v-if="imageStyle" class="cover__image" :style="imageStyle"></div>
    </div>
</template>
