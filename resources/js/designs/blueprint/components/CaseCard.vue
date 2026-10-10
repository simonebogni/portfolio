<script setup>
import DraftText from './DraftText.vue';
import SpecList from './SpecList.vue';

/**
 * Case-study card: kind label, title, summary and actions on the left, a spec
 * sheet on the right. `draft` gives it the dashed placeholder border.
 */
defineProps({
    kind: { type: String, default: '' },
    title: { type: String, required: true },
    summary: { type: String, default: '' },
    meta: { type: Array, default: () => [] },
    draft: { type: Boolean, default: false },
    level: { type: Number, default: 2 },
});
</script>

<template>
    <li class="case" :class="{ 'case--draft': draft }">
        <div class="case__main">
            <span v-if="kind" class="kicker">{{ kind }}</span>
            <component :is="`h${level}`" class="case__title"><DraftText :text="title" /></component>
            <DraftText v-if="summary" as="p" class="case__summary" :text="summary" />
            <div v-if="$slots.actions" class="case__actions"><slot name="actions" /></div>
        </div>
        <SpecList v-if="meta.length" class="case__meta" :items="meta" />
    </li>
</template>
