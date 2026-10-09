<script setup>
import { computed } from 'vue';
import { monogram, pad2 } from '../lib/format';
import BaseButton from './BaseButton.vue';
import TagList from './TagList.vue';

/** The large featured project card: an orange slab with a monogram, then the details. */
const props = defineProps({
    item: { type: Object, required: true },
    index: { type: Number, default: 1 },
    category: { type: String, default: '' },
});

const headingId = computed(() => `feature-${props.item.id}`);
</script>

<template>
    <article class="project-feature" :aria-labelledby="headingId">
        <div class="project-feature__slab" aria-hidden="true">
            <span class="label">Featured · {{ pad2(index) }}</span>
            <b class="project-feature__monogram display">{{ monogram(item.title) }}</b>
        </div>
        <div class="project-feature__body">
            <p v-if="category" class="project-feature__category label text-accent">{{ category }}</p>
            <h2 :id="headingId" class="project-feature__title display">{{ item.title }}</h2>
            <p v-if="item.subtitle" class="project-feature__subtitle">{{ item.subtitle }}</p>
            <p v-if="item.description" class="project-feature__description">{{ item.description }}</p>
            <TagList :tags="item.tags" />
            <div v-if="item.liveUrl || item.gitRepoUrl" class="project-feature__actions">
                <BaseButton v-if="item.liveUrl" :href="item.liveUrl" variant="inverse">Live site<span class="visually-hidden"> of {{ item.title }}</span></BaseButton>
                <BaseButton v-if="item.gitRepoUrl" :href="item.gitRepoUrl" variant="outline">Source code<span class="visually-hidden"> of {{ item.title }}</span></BaseButton>
            </div>
        </div>
    </article>
</template>
