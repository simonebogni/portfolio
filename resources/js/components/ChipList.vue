<script setup>
import { computed, ref, useId } from 'vue';

/**
 * A list of pill chips (tags, technologies).
 * With `limit`, only the first items show, plus a button that reveals the rest.
 */
const props = defineProps({
    items: { type: Array, required: true },
    label: { type: String, default: null },
    size: { type: String, default: 'md', validator: (value) => ['sm', 'md'].includes(value) },
    surface: { type: String, default: 'sunken', validator: (value) => ['sunken', 'raised'].includes(value) },
    limit: { type: Number, default: 0 },
});

const listId = useId();
const expanded = ref(false);
const hiddenCount = computed(() => (props.limit > 0 ? Math.max(props.items.length - props.limit, 0) : 0));
const visible = computed(() => (hiddenCount.value > 0 && !expanded.value ? props.items.slice(0, props.limit) : props.items));
</script>

<template>
    <div class="chips-wrap">
        <ul :id="listId" class="chips" :class="[`chips--${size}`, `chips--${surface}`]" :aria-label="label ?? undefined">
            <li v-for="item in visible" :key="item">{{ item }}</li>
        </ul>
        <button
            v-if="hiddenCount > 0"
            class="chips-more"
            type="button"
            :aria-expanded="expanded"
            :aria-controls="listId"
            @click="expanded = !expanded"
        >
            {{ expanded ? 'Show fewer' : `+${hiddenCount} more` }}<span v-if="label" class="visually-hidden"> {{ label.toLowerCase() }}</span>
        </button>
    </div>
</template>
