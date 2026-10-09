<script setup>
/** One role in the experience timeline: period, title, organisation, body (slot) and chips (slot "chips"). */
defineProps({
    when: { type: String, required: true },
    title: { type: String, required: true },
    org: { type: String, default: '' },
    whenPlaceholder: { type: Boolean, default: false },
});
</script>

<template>
    <li class="timeline-entry">
        <p class="timeline-entry__when" :class="{ 'is-placeholder': whenPlaceholder }">{{ when }}</p>
        <h3 class="timeline-entry__title">{{ title }}</h3>
        <p v-if="org" class="timeline-entry__org">{{ org }}</p>
        <div class="timeline-entry__body">
            <slot />
        </div>
        <slot name="chips" />
    </li>
</template>
