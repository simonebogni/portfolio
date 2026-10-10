<script setup lang="ts">
import type { Project } from '@core/entities/project';
import { BaseButton, ChipList, Icon, type IconName } from '@designs/bento/shared/ui';
import { computed, ref, useId } from 'vue';
import { monogram as monogramOf } from '../model/monogram';

/**
 * A portfolio project card. The featured variant is larger, shows the cover image
 * and the technologies; the others show a monogram panel.
 */
const props = withDefaults(
    defineProps<{
        project: Project;
        kind?: string;
        size?: 'wide' | 'half' | 'third' | 'full';
        featured?: boolean;
        inverseArt?: boolean;
    }>(),
    { kind: '', size: 'third', featured: false, inverseArt: false },
);

interface ProjectLink {
    href: string;
    text: string;
    icon: IconName;
}

const imageFailed = ref(false);
const descriptionId = useId();
const expanded = ref(false);
/** Long descriptions on the smaller cards are clamped to a few lines, with a toggle to read the rest. */
const clampable = computed(() => !props.featured && String(props.project.description ?? '').length > 180);
const showImage = computed(() => props.featured && Boolean(props.project.coverImgUrl) && !imageFailed.value);
const monogram = computed(() => monogramOf(props.project.title));

const links = computed(() => {
    const list: ProjectLink[] = [];

    if (props.project.liveUrl) {
        list.push({ href: props.project.liveUrl, text: 'Live site', icon: 'arrow-up-right' });
    }

    if (props.project.gitRepoUrl) {
        list.push({ href: props.project.gitRepoUrl, text: 'Source code', icon: 'github' });
    }

    return list;
});
</script>

<template>
    <li class="project" :class="[`project--${size}`, { 'project--featured': featured }]">
        <div class="project__art" :class="{ 'tone-inverse': inverseArt && !showImage }">
            <img
                v-if="showImage && project.coverImgUrl"
                :src="project.coverImgUrl"
                :alt="`Screenshot of ${project.title}`"
                loading="lazy"
                @error="imageFailed = true"
            />
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
