<script setup>
import { computed, onMounted, ref, useTemplateRef } from 'vue';
import { padNumber, paragraphs } from '../lib/format';
import ActionLink from './ActionLink.vue';
import Kicker from './Kicker.vue';
import MetaList from './MetaList.vue';

/**
 * Large feature block: a plate (cover image, or the project number set large) and
 * the project's title, description, technologies and links.
 */
const props = defineProps({
    project: { type: Object, required: true },
    number: { type: Number, required: true },
    category: { type: String, default: '' },
    headingId: { type: String, required: true },
});

const imageFailed = ref(false);
const image = useTemplateRef('image');

// An image that failed before hydration never fires @error on the client, so check it once mounted.
onMounted(() => {
    if (image.value && image.value.complete && image.value.naturalWidth === 0) {
        imageFailed.value = true;
    }
});

const text = computed(() => paragraphs(props.project.description));
</script>

<template>
    <article class="feature" :aria-labelledby="headingId">
        <div class="feature__plate" aria-hidden="true">
            <span class="feature__plate-label">{{ category }}</span>
            <b class="feature__plate-number">{{ padNumber(number) }}</b>
            <img
                v-if="project.coverImgUrl && !imageFailed"
                ref="image"
                class="feature__image"
                :src="project.coverImgUrl"
                alt=""
                loading="lazy"
                @error="imageFailed = true"
            >
        </div>
        <div class="feature__body">
            <Kicker>Featured project</Kicker>
            <h2 :id="headingId" class="feature__title">{{ project.title }}</h2>
            <p v-if="project.subtitle" class="feature__subtitle">{{ project.subtitle }}</p>
            <p v-for="(line, index) in text" :key="index" class="feature__text">{{ line }}</p>
            <MetaList class="feature__tags" :items="project.tags" label="Technologies" />
            <div v-if="project.liveUrl || project.gitRepoUrl" class="feature__actions">
                <ActionLink v-if="project.liveUrl" :href="project.liveUrl" variant="solid" external>
                    Live site<span class="visually-hidden"> of {{ project.title }}</span>
                </ActionLink>
                <ActionLink v-if="project.gitRepoUrl" :href="project.gitRepoUrl" external>
                    Source code<span class="visually-hidden"> of {{ project.title }}</span>
                </ActionLink>
            </div>
        </div>
    </article>
</template>
