<script setup>
import { computed, ref, useId } from 'vue';
import BaseButton from './BaseButton.vue';
import ChipList from './ChipList.vue';
import Icon from './Icon.vue';

/**
 * A portfolio project card. The featured variant is larger, shows the cover image
 * and the technologies; the others show a monogram panel.
 */
const props = defineProps({
    project: { type: Object, required: true },
    kind: { type: String, default: '' },
    size: { type: String, default: 'third', validator: (value) => ['wide', 'half', 'third', 'full'].includes(value) },
    featured: { type: Boolean, default: false },
    inverseArt: { type: Boolean, default: false },
});

const imageFailed = ref(false);
const descriptionId = useId();
const expanded = ref(false);
/** Long descriptions on the smaller cards are clamped to a few lines, with a toggle to read the rest. */
const clampable = computed(() => !props.featured && String(props.project.description ?? '').length > 180);
const showImage = computed(() => props.featured && props.project.coverImgUrl && !imageFailed.value);

/** "Interactive CV and Portfolio" → "IC"; single words keep their first two letters. */
const monogram = computed(() => {
    const words = String(props.project.title).replace(/[^\p{L}\p{N}\s-]/gu, '').split(/[\s-]+/).filter(Boolean);

    if (words.length === 1) {
        return words[0].slice(0, 2).toUpperCase();
    }

    return words.slice(0, 2).map((word) => word[0].toUpperCase()).join('');
});

const links = computed(() =>
    [
        props.project.liveUrl && { href: props.project.liveUrl, text: 'Live site', icon: 'arrow-up-right' },
        props.project.gitRepoUrl && { href: props.project.gitRepoUrl, text: 'Source code', icon: 'github' },
    ].filter(Boolean),
);
</script>

<template>
    <li class="project" :class="[`project--${size}`, { 'project--featured': featured }]">
        <div class="project__art" :class="{ 'tone-inverse': inverseArt && !showImage }">
            <img
                v-if="showImage"
                :src="project.coverImgUrl"
                :alt="`Screenshot of ${project.title}`"
                loading="lazy"
                @error="imageFailed = true"
            >
            <span v-else aria-hidden="true">{{ monogram }}</span>
        </div>
        <div class="project__body">
            <p class="project__kind">{{ kind }}</p>
            <h2 class="project__title">{{ project.title }}</h2>
            <p v-if="project.subtitle" class="project__subtitle">{{ project.subtitle }}</p>
            <p :id="descriptionId" class="project__desc" :class="{ 'is-clamped': clampable && !expanded }">{{ project.description }}</p>
            <button
                v-if="clampable"
                class="text-toggle"
                type="button"
                :aria-expanded="expanded"
                :aria-controls="descriptionId"
                @click="expanded = !expanded"
            >
                {{ expanded ? 'Show less' : 'Read more' }}<span class="visually-hidden"> about {{ project.title }}</span>
            </button>
            <ChipList v-if="project.tags?.length" :items="project.tags" label="Technologies" size="sm" :limit="featured ? 8 : 4" />
            <div v-if="links.length" class="project__links">
                <template v-if="featured">
                    <BaseButton v-for="(link, index) in links" :key="link.href" :href="link.href" :variant="index === 0 ? 'primary' : 'ghost'">
                        {{ link.text }}<span class="visually-hidden">: {{ project.title }}</span>
                        <Icon :name="link.icon" :size="18" />
                    </BaseButton>
                </template>
                <a v-for="link in links" v-else :key="link.href" class="go" :href="link.href" target="_blank" rel="noopener noreferrer">
                    {{ link.text }}<span class="visually-hidden">: {{ project.title }} (opens in a new tab)</span>
                    <Icon :name="link.icon" :size="18" />
                </a>
            </div>
        </div>
    </li>
</template>
