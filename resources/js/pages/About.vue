<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseButton from '../components/BaseButton.vue';
import LeafRating from '../components/LeafRating.vue';
import SectionHeading from '../components/SectionHeading.vue';
import StatStrip from '../components/StatStrip.vue';
import SurfaceCard from '../components/SurfaceCard.vue';
import TagList from '../components/TagList.vue';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
    highlights: { type: Object, required: true },
});

const profile = computed(() => usePage().props.profile);
const firstName = computed(() => profile.value.name.split(' ')[0]);

/** The headline with its last word split off, so it can be underlined like a marker stroke. */
const headline = computed(() => {
    const text = (profile.value.headline ?? '').trim();
    const match = text.match(/^(.*\s)?(\S+?)([.!?]?)$/s);

    return match ? { lead: match[1] ?? '', mark: match[2], end: match[3] } : null;
});

const stats = computed(() =>
    [
        { count: props.highlights.projects, singular: 'portfolio project' },
        { count: props.highlights.certificates, singular: 'certification' },
        { count: props.languages.length, singular: 'spoken language' },
        { count: props.highlights.awards, singular: 'award' },
    ]
        .filter((stat) => stat.count > 0)
        .map((stat) => ({ value: stat.count, label: stat.count === 1 ? stat.singular : `${stat.singular}s` })),
);

const skillCards = computed(() =>
    props.skillCategories.map((category) => ({
        id: category.id,
        name: category.name,
        skills: category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)),
    })),
);

function languageLevel(language) {
    return [language.isNative ? 'Native' : language.speaking || language.ratingMeaning, language.certificateLevel]
        .filter(Boolean)
        .join(' · ');
}
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero__text">
                <p class="hero__hello" lang="it">Ciao!</p>
                <h1 id="hero-title" class="hero__title">
                    <template v-if="headline">
                        I’m {{ firstName }}, {{ headline.lead }}<span class="marker">{{ headline.mark }}</span>{{ headline.end }}
                    </template>
                    <template v-else>{{ profile.name }}</template>
                </h1>
                <p v-if="profile.bio" class="hero__bio">{{ profile.bio }}</p>
                <p class="hero__roles">{{ profile.roles.join(' · ') }}</p>
                <div class="hero__actions">
                    <BaseButton href="/portfolio" icon="arrow" block>Explore my work</BaseButton>
                    <BaseButton v-if="profile.email" :href="`mailto:${profile.email}`" variant="ghost" block>Say hello</BaseButton>
                    <BaseButton v-else href="/experience" variant="ghost" block>See my experience</BaseButton>
                </div>
            </div>
            <div class="portrait">
                <div class="portrait__blob terrain" aria-hidden="true" />
                <img
                    class="portrait__image"
                    src="/assets/img/profile.jpg"
                    :alt="`Portrait of ${profile.name}`"
                    width="480"
                    height="480"
                >
                <p v-if="profile.location" class="portrait__badge">
                    <span>Based in</span>
                    <strong>{{ profile.location }}</strong>
                </p>
            </div>
        </section>

        <StatStrip v-if="stats.length" class="page-about__stats" :items="stats" />

        <section class="page-section" aria-labelledby="skills-title">
            <SectionHeading id="skills-title" eyebrow="Toolbox" title="What I build with" />
            <ul class="grid grid--3 grid--fill-last plain-list">
                <SurfaceCard v-for="category in skillCards" :key="category.id" as="li" class="skill-card">
                    <h3 class="card__title">{{ category.name }}</h3>
                    <TagList :tags="category.skills" :label="`${category.name} skills`" />
                </SurfaceCard>
            </ul>
        </section>

        <section class="page-section" aria-labelledby="languages-title">
            <SectionHeading id="languages-title" eyebrow="Communication" title="Languages I speak" />
            <ul class="grid grid--2 plain-list">
                <SurfaceCard v-for="language in languages" :key="language.id" as="li" class="language">
                    <h3 class="language__name">{{ language.name }}</h3>
                    <p class="language__level">{{ languageLevel(language) }}</p>
                    <LeafRating
                        class="language__rating"
                        :value="Number(language.rating)"
                        :label="`${language.name}: ${language.rating} out of 5`"
                    />
                </SurfaceCard>
            </ul>
        </section>
    </div>
</template>
