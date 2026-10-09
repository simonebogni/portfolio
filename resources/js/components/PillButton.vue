<script setup>
/** Outlined pill button used for toggles and filters (44px tall). Extra attributes pass through. */
defineProps({
    pressed: { type: Boolean, default: undefined },
});
</script>

<template>
    <button class="pill-button" type="button" :aria-pressed="pressed === undefined ? undefined : String(pressed)">
        <slot />
    </button>
</template>
