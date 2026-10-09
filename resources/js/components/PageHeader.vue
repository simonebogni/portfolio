<script setup>
import Eyebrow from './Eyebrow.vue';

/**
 * The top of an inner page: eyebrow, the page's single <h1>, and an optional lede.
 * layout "split" puts the lede in a second column on wide screens.
 * The `lede` slot replaces the lede paragraph (e.g. a pull quote).
 */
defineProps({
    eyebrow: { type: String, default: '' },
    title: { type: String, required: true },
    lede: { type: String, default: '' },
    layout: { type: String, default: 'stack', validator: (value) => ['stack', 'split'].includes(value) },
});
</script>

<template>
    <header class="page-header" :class="`page-header--${layout}`">
        <div>
            <Eyebrow v-if="eyebrow">{{ eyebrow }}</Eyebrow>
            <h1 class="page-header__title">{{ title }}</h1>
        </div>
        <slot name="lede">
            <p v-if="lede" class="page-header__lede">{{ lede }}</p>
        </slot>
    </header>
</template>
