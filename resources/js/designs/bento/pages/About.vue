<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseButton from '../components/BaseButton.vue';
import BentoGrid from '../components/BentoGrid.vue';
import BentoTile from '../components/BentoTile.vue';
import ChipList from '../components/ChipList.vue';
import ContactTile from '../components/ContactTile.vue';
import LanguageMeter from '../components/LanguageMeter.vue';
import TileHeading from '../components/TileHeading.vue';
import TileLabel from '../components/TileLabel.vue';
import { useProfile } from '../composables/useProfile';
import { findOrdinal, formatYear } from '../lib/format';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
    education: { type: Object, default: null },
    award: { type: Object, default: null },
    stack: { type: Array, default: () => [] },
});

const { profile, city } = useProfile();

/** The headline with its last word split off, so it can take the accent colour. */
const headline = computed(() => {
    const text = String(profile.value.headline || profile.value.name).trim();
    const match = text.match(/^(.*\s)(\S+?)([.!?]?)$/);

    return match ? { start: match[1], accent: match[2], end: match[3] } : { start: '', accent: text, end: '' };
});

const status = computed(() => profile.value.availability || [profile.value.current_role?.title, city.value].filter(Boolean).join(' · '));

const currentLine = computed(() => {
    const role = profile.value.current_role ?? {};
    const parts = [`Based in ${profile.value.location}.`];

    if (role.company) {
        parts.push(`${role.title} at ${role.company}${role.since ? ` since ${role.since}` : ''}.`);
    }

    return parts.join(' ');
});

const rolesTitle = computed(() => {
    const roles = profile.value.roles ?? [];

    return roles.length > 1 ? `${roles.slice(0, -1).join(', ')} & ${roles.at(-1)}` : (roles[0] ?? '');
});

const categories = computed(() =>
    props.skillCategories.map((category) => ({
        ...category,
        skills: category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)),
    })),
);

const skillCount = computed(() => categories.value.reduce((total, category) => total + category.skills.length, 0));

const educationFigure = computed(() => profile.value.education_score || (props.education?.endYear ? String(props.education.endYear) : null));
const awardYear = computed(() => formatYear(props.award?.issueDate));
const awardFigure = computed(() => findOrdinal(props.award?.title) ?? awardYear.value);

function languageLevel(language) {
    const level = language.isNative ? 'Native' : language.ratingMeaning;

    return language.certificateLevel ? `${level} · ${language.certificateLevel}` : level;
}
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <BentoGrid>
            <BentoTile :span="7" :rows="2" padding="lg" class="hero" aria-labelledby="hero-title">
                <div class="hero__top">
                    <img class="avatar" src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="72" height="72">
                    <p v-if="status" class="status"><span class="status__dot" aria-hidden="true" />{{ status }}</p>
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
                <TileLabel as="h2" id="stack-title">Most-used stack</TileLabel>
                <ChipList :items="stack" />
            </BentoTile>

            <BentoTile v-if="education" :span="4" aria-labelledby="edu-title">
                <TileLabel as="h2" id="edu-title">Education<template v-if="!profile.education_score && education.endYear"> · graduated</template></TileLabel>
                <p v-if="educationFigure" class="figure">{{ educationFigure }}</p>
                <p class="muted">{{ education.name }}, {{ education.institute }}</p>
            </BentoTile>

            <BentoTile v-if="award" :span="4" tone="inverse" aria-labelledby="award-title">
                <TileLabel as="h2" id="award-title">Award<template v-if="awardYear"> · {{ awardYear }}</template></TileLabel>
                <p v-if="awardFigure" class="figure">{{ awardFigure }}</p>
                <p>{{ award.title }}<template v-if="award.subtitle">. {{ award.subtitle }}</template></p>
            </BentoTile>

            <BentoTile v-if="languages.length" :span="4" aria-labelledby="lang-title">
                <TileLabel as="h2" id="lang-title">Languages</TileLabel>
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
