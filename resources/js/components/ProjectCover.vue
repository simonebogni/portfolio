<script setup>
import { computed } from 'vue';

/**
 * Decorative cover for a project. Draws a monogram (or an abstract UI sketch
 * with `mock`) and lays the screenshot on top when it loads, so a missing
 * image never shows as broken.
 */
const props = defineProps({
    title: { type: String, required: true },
    imageUrl: { type: String, default: null },
    mock: { type: Boolean, default: false },
});

const monogram = computed(() => {
    const words = props.title.split(/[\s-]+/).filter((word) => /^[A-Za-z0-9]/.test(word));

    if (words.length > 1) {
        return words
            .slice(0, 2)
            .map((word) => word[0])
            .join('')
            .toUpperCase();
    }

    const capitals = props.title.replace(/[^A-Z]/g, '');

    return (capitals.length >= 2 ? capitals.slice(-3) : props.title.slice(0, 2)).toUpperCase();
});

const imageStyle = computed(() => (props.imageUrl ? { backgroundImage: `url("${props.imageUrl.replace(/["\\\n]/g, '')}")` } : null));
</script>

<template>
    <div class="cover" aria-hidden="true">
        <div v-if="mock" class="cover__mock">
            <i class="cover__mock-accent" />
            <i style="width: 70%" />
            <div class="cover__mock-row"><i /><i /><i /></div>
            <i style="width: 55%" />
            <i style="width: 85%" />
        </div>
        <span v-else class="cover__monogram">{{ monogram }}</span>
        <div v-if="imageStyle" class="cover__image" :style="imageStyle" />
    </div>
</template>
