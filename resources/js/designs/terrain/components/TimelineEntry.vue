<script setup>
/**
 * One stop on the experience trail: a map-pin marker and a leaf card.
 * Use inside <ol class="trail">. The pin is decorative; put the dates in the card.
 */
defineProps({
    marker: { type: String, required: true },
    title: { type: String, required: true },
    when: { type: String, default: null },
    org: { type: String, default: null },
    /** Outlined pin, for an ongoing role. */
    ghost: { type: Boolean, default: false },
});
</script>

<template>
    <li class="trail__stop">
        <span class="pin" :class="{ 'pin--ghost': ghost }" aria-hidden="true"><span>{{ marker }}</span></span>
        <article class="card card--leaf card--default trail__card">
            <div class="trail__head">
                <h3 class="trail__title">{{ title }}</h3>
                <p v-if="when" class="trail__when">{{ when }}</p>
            </div>
            <p v-if="org" class="trail__org">{{ org }}</p>
            <slot />
        </article>
    </li>
</template>
