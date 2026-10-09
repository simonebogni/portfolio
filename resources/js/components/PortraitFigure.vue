<script setup>
/** Portrait photo with a floating caption card showing one figure (e.g. the team size). */
defineProps({
    src: { type: String, required: true },
    alt: { type: String, required: true },
    figure: { type: [String, Number], default: '' },
    caption: { type: String, default: '' },
});
</script>

<template>
    <figure class="portrait">
        <img class="portrait__image" :src="src" :alt="alt" width="460" height="575">
        <figcaption v-if="figure || caption" class="portrait__caption">
            <b v-if="figure !== ''" class="portrait__figure">{{ figure }}</b>
            <span>{{ caption }}</span>
        </figcaption>
    </figure>
</template>
