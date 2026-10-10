<script setup>
/**
 * A card in the bento grid.
 * - span: columns out of 12 on wide screens (full width on small screens).
 * - rows: rows to span on wide screens.
 * - tone: surface (white card), inverse (dark card), accent (violet card), dashed (placeholder outline).
 * - padding: md (default) or lg (hero and page headers), none (media cards).
 */
defineProps({
    as: { type: String, default: 'section' },
    span: { type: Number, default: 4 },
    rows: { type: Number, default: 1 },
    tone: { type: String, default: 'surface', validator: (value) => ['surface', 'inverse', 'accent', 'dashed'].includes(value) },
    padding: { type: String, default: 'md', validator: (value) => ['none', 'md', 'lg'].includes(value) },
});
</script>

<template>
    <component
        :is="as"
        class="tile"
        :class="[`tile--span-${span}`, `tile--pad-${padding}`, `tone-${tone}`, { 'tile--rows-2': rows === 2 }]"
    >
        <slot />
    </component>
</template>
