<script setup lang="ts">
import DraftText from './DraftText.vue';
import SpecList from './SpecList.vue';
import type { LabelledValue } from './types';

/**
 * Case-study card: kind label, title, summary and actions on the left, a spec
 * sheet on the right. `draft` gives it the dashed placeholder border.
 */
withDefaults(
    defineProps<{
        kind?: string;
        title: string;
        summary?: string | null;
        meta?: readonly LabelledValue[];
        draft?: boolean;
        level?: number;
    }>(),
    { kind: '', summary: '', meta: () => [], level: 2 },
);
</script>

<template>
    <li class="case" :class="{ 'case--draft': draft }">
        <div class="case__main">
            <span v-if="kind" class="kicker">{{ kind }}</span>
            <component :is="`h${level}`" class="case__title"><DraftText :text="title" /></component>
            <DraftText v-if="summary" as="p" class="case__summary" :text="summary" />
            <div v-if="$slots.actions" class="case__actions"><slot name="actions"></slot></div>
        </div>
        <SpecList v-if="meta.length" class="case__meta" :items="meta" />
    </li>
</template>
