<script setup>
/** One role on the experience timeline: period, title, body slot. Render inside <ol class="timeline">. */
defineProps({
    when: { type: String, required: true },
    title: { type: String, required: true },
    level: { type: Number, default: 3 },
});
</script>

<template>
    <li class="timeline__entry">
        <span class="when">{{ when }}</span>
        <component :is="`h${level}`" class="timeline__title">{{ title }}</component>
        <slot />
    </li>
</template>
