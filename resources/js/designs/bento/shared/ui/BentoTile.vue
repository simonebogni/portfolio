<script setup lang="ts">
/**
 * A card in the bento grid.
 * - span: columns out of 12 on wide screens (full width on small screens).
 * - rows: rows to span on wide screens.
 * - tone: surface (white card), inverse (dark card), accent (violet card), dashed (placeholder outline).
 * - padding: md (default) or lg (hero and page headers), none (media cards).
 */
withDefaults(
    defineProps<{
        as?: string;
        span?: number;
        rows?: number;
        tone?: 'surface' | 'inverse' | 'accent' | 'dashed';
        padding?: 'none' | 'md' | 'lg';
    }>(),
    { as: 'section', span: 4, rows: 1, tone: 'surface', padding: 'md' },
);
</script>

<template>
    <component
        :is="as"
        class="tile"
        :class="[`tile--span-${span}`, `tile--pad-${padding}`, `tone-${tone}`, { 'tile--rows-2': rows === 2 }]"
    >
        <slot></slot>
    </component>
</template>
