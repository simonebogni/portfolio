<script setup>
import Kicker from './Kicker.vue';

/**
 * Page masthead: kicker, the page's single <h1> (default slot) and an optional lede.
 * layout "stack" puts the lede under the title, "split" puts it in a second column.
 * lede-style "standfirst" sets the lede as a large serif italic line.
 */
defineProps({
    kicker: { type: String, default: '' },
    lede: { type: String, default: '' },
    layout: { type: String, default: 'stack', validator: (value) => ['stack', 'split'].includes(value) },
    ledeStyle: { type: String, default: 'plain', validator: (value) => ['plain', 'standfirst'].includes(value) },
    ruled: { type: Boolean, default: false },
});
</script>

<template>
    <header class="page-header" :class="[`page-header--${layout}`, { 'page-header--ruled': ruled }]">
        <div class="page-header__titles">
            <Kicker v-if="kicker">{{ kicker }}</Kicker>
            <h1 class="page-header__title"><slot /></h1>
        </div>
        <p v-if="lede" class="page-header__lede" :class="`page-header__lede--${ledeStyle}`">{{ lede }}</p>
    </header>
</template>
