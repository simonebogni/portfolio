<script setup lang="ts">
import type { Project } from '@core/entities/project';
import { paragraphs } from '@core/shared/lib';
import { BaseButton, EyebrowText, MonogramBadge, TagList } from '@designs/terrain/shared/ui';
import { computed, onMounted, ref } from 'vue';

/**
 * Large project card on a contour-line "terrain" panel. Shows the cover image when it
 * loads, and the project monogram otherwise.
 */
const props = withDefaults(
    defineProps<{
        item: Project;
        eyebrow?: string | null;
    }>(),
    { eyebrow: null },
);

const imageFailed = ref(false);
const image = ref<HTMLImageElement | null>(null);

// The image may fail before hydration attaches @error; check once mounted.
onMounted(() => {
    if (image.value?.complete && image.value.naturalWidth === 0) {
        imageFailed.value = true;
    }
});
const text = computed(() => paragraphs(props.item.description));
const headingId = computed(() => `featured-${props.item.slug ?? props.item.id}`);
</script>

<template>
    <article class="feature" :aria-labelledby="headingId">
        <div class="feature__media terrain">
            <img
                v-if="item.coverImgUrl && !imageFailed"
                ref="image"
                class="feature__image"
                :src="item.coverImgUrl"
                :alt="`Screenshot of ${item.title}`"
                width="640"
                height="360"
                @error="imageFailed = true"
            />
            <MonogramBadge v-else :text="item.title" size="xl" />
        </div>
        <div class="feature__body">
            <EyebrowText v-if="eyebrow">{{ eyebrow }}</EyebrowText>
            <h2 :id="headingId" class="feature__title">{{ item.title }}</h2>
            <p v-if="item.subtitle" class="feature__subtitle">{{ item.subtitle }}</p>
            <div class="feature__text">
                <p v-for="(paragraph, index) in text" :key="index">{{ paragraph }}</p>
            </div>
            <TagList v-if="item.tags.length" :tags="item.tags" label="Technologies" :limit="8" />
            <div class="feature__actions">
                <BaseButton v-if="item.liveUrl" :href="item.liveUrl">Visit the live site</BaseButton>
                <BaseButton v-if="item.gitRepoUrl" :href="item.gitRepoUrl" variant="ghost">View the source</BaseButton>
            </div>
        </div>
    </article>
</template>
