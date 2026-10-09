<script setup>
/**
 * One dated entry (a job, a degree, an award): a date column with a large serif
 * marker ("2020", "Now") and the period, then the title, the organisation and a body slot.
 */
defineProps({
    marker: { type: String, default: '' },
    when: { type: String, default: '' },
    title: { type: String, required: true },
    org: { type: String, default: '' },
    headingLevel: { type: Number, default: 3 },
});
</script>

<template>
    <article class="entry">
        <div class="entry__body">
            <component :is="`h${headingLevel}`" class="entry__title">{{ title }}</component>
            <p v-if="org" class="entry__org">{{ org }}</p>
            <slot />
        </div>
        <!-- After the body in the source, so the title is read first; CSS places it in the left column. -->
        <p class="entry__date">
            <span v-if="marker" class="entry__marker">{{ marker }}</span>
            <span v-if="when">{{ when }}</span>
        </p>
    </article>
</template>
