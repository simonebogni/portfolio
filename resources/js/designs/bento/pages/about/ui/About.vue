<script setup lang="ts">
import { findOrdinal, formatYear } from '@core/shared/lib';
import { languageLevel, LanguageMeter } from '@designs/bento/entities/language';
import { useProfile } from '@designs/bento/entities/profile';
import { BaseButton, BentoGrid, BentoTile, ChipList, TileHeading, TileLabel } from '@designs/bento/shared/ui';
import { ContactTile } from '@designs/bento/widgets/contact-tile';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { currentLine as currentLineOf, rolesTitle as rolesTitleOf, skillAreas, splitHeadline, statusLine } from '../model/about';
import type { AboutProps } from '../model/types';

const props = withDefaults(defineProps<AboutProps>(), { education: null, award: null, stack: () => [] });

const { profile, city } = useProfile();

/** The headline with its last word split off, so it can take the accent colour. */
const headline = computed(() => splitHeadline(String(profile.value.headline || profile.value.name)));
const status = computed(() => statusLine(profile.value, city.value));
const currentLine = computed(() => currentLineOf(profile.value));
const rolesTitle = computed(() => rolesTitleOf(profile.value.roles));

const categories = computed(() => skillAreas(props.skillCategories));
const skillCount = computed(() => categories.value.reduce((total, category) => total + category.skills.length, 0));

const educationFigure = computed(() => profile.value.education_score || (props.education?.endYear ? String(props.education.endYear) : null));
const awardYear = computed(() => formatYear(props.award?.issueDate));
const awardFigure = computed(() => findOrdinal(props.award?.title) ?? awardYear.value);
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <BentoGrid>
            <BentoTile :span="7" :rows="2" padding="lg" class="hero" aria-labelledby="hero-title">
                <div class="hero__top">
                    <img class="avatar" src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="72" height="72" />
                    <p v-if="status" class="status"><span class="status__dot" aria-hidden="true"></span>{{ status }}</p>
                </div>
                <h1 id="hero-title" class="display">
                    <span class="visually-hidden">{{ profile.name }}: </span>{{ headline.start }}<span class="accent-text">{{ headline.accent }}</span>{{ headline.end }}
                </h1>
                <p v-if="profile.bio" class="lead">{{ profile.bio }}</p>
                <div class="actions">
                    <BaseButton href="/portfolio">See my projects</BaseButton>
                    <BaseButton href="/experience" variant="ghost">Experience</BaseButton>
                </div>
            </BentoTile>

            <BentoTile :span="5" aria-labelledby="now-title">
                <TileLabel>Currently</TileLabel>
                <h2 id="now-title" class="tile-title">{{ rolesTitle }}</h2>
                <p class="muted">{{ currentLine }}</p>
            </BentoTile>

            <BentoTile v-if="stack.length" :span="5" aria-labelledby="stack-title">
                <TileLabel id="stack-title" as="h2">Most-used stack</TileLabel>
                <ChipList :items="stack" />
            </BentoTile>

            <BentoTile v-if="education" :span="4" aria-labelledby="edu-title">
                <TileLabel id="edu-title" as="h2">Education<template v-if="!profile.education_score && education.endYear"> · graduated</template></TileLabel>
                <p v-if="educationFigure" class="figure">{{ educationFigure }}</p>
                <p class="muted">{{ education.name }}, {{ education.institute }}</p>
            </BentoTile>

            <BentoTile v-if="award" :span="4" tone="inverse" aria-labelledby="award-title">
                <TileLabel id="award-title" as="h2">Award<template v-if="awardYear"> · {{ awardYear }}</template></TileLabel>
                <p v-if="awardFigure" class="figure">{{ awardFigure }}</p>
                <p>{{ award.title }}<template v-if="award.subtitle">. {{ award.subtitle }}</template></p>
            </BentoTile>

            <BentoTile v-if="languages.length" :span="4" aria-labelledby="lang-title">
                <TileLabel id="lang-title" as="h2">Languages</TileLabel>
                <ul class="langs">
                    <LanguageMeter
                        v-for="language in languages"
                        :key="language.id"
                        :name="language.name"
                        :level="languageLevel(language)"
                        :rating="language.rating"
                    />
                </ul>
            </BentoTile>

            <BentoTile v-if="categories.length" :span="12" aria-labelledby="skills-title">
                <TileHeading id="skills-title" :meta="`${categories.length} areas · ${skillCount} tools`">Programming knowledge</TileHeading>
                <ul class="mini-grid">
                    <li v-for="category in categories" :key="category.id" class="mini-card">
                        <h3 class="mini-card__title">{{ category.name }}</h3>
                        <p class="muted">{{ category.skills.join(', ') }}</p>
                    </li>
                </ul>
            </BentoTile>

            <ContactTile />
        </BentoGrid>
    </div>
</template>
