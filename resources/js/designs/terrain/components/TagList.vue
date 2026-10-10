<script setup>
import { computed, ref } from 'vue';

/**
 * A list of chips. With `limit`, the extra tags are hidden behind a "+N more" button.
 */
const props = defineProps({
    tags: { type: Array, required: true },
    label: { type: String, default: null },
    limit: { type: Number, default: 0 },
});

const expanded = ref(false);
const hiddenCount = computed(() => (props.limit > 0 ? Math.max(props.tags.length - props.limit, 0) : 0));
const visible = computed(() => (expanded.value || hiddenCount.value === 0 ? props.tags : props.tags.slice(0, props.limit)));
</script>

<template>
    <ul class="tags" :aria-label="label ?? undefined">
        <li v-for="tag in visible" :key="tag" class="tag">{{ tag }}</li>
        <li v-if="hiddenCount > 0" class="tags__more">
            <button type="button" class="tag tag--button" :aria-expanded="expanded ? 'true' : 'false'" @click="expanded = !expanded">
                {{ expanded ? 'Show fewer' : `+${hiddenCount} more` }}
            </button>
        </li>
    </ul>
</template>
