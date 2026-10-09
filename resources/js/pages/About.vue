<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ActionLink from '../components/ActionLink.vue';
import EmphasisText from '../components/EmphasisText.vue';
import FactList from '../components/FactList.vue';
import Kicker from '../components/Kicker.vue';
import RatingDots from '../components/RatingDots.vue';
import SectionHeading from '../components/SectionHeading.vue';
import { padNumber } from '../lib/format';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);

const skillAreas = computed(() =>
    props.skillCategories.map((category) => ({
        id: category.id,
        name: category.name,
        skills: category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)),
    })),
);

const facts = computed(() =>
    [
        profile.value.current_role?.title && { label: 'Role', value: profile.value.current_role.title },
        profile.value.current_role?.company && { label: 'Company', value: profile.value.current_role.company },
        profile.value.location && { label: 'Location', value: profile.value.location },
        props.languages.length && { label: 'Languages', value: props.languages.map((language) => language.name).join(' · ') },
        profile.value.availability && { label: 'Availability', value: profile.value.availability },
    ].filter(Boolean),
);

function languageLevel(language) {
    return [language.speaking || language.ratingMeaning, language.certificateLevel].filter(Boolean).join(' · ');
}
</script>

<template>
    <div class="page page--about">
        <Head title="About" />
        <section class="hero" aria-labelledby="hero-title">
            <Kicker>{{ profile.roles.join(' · ') }}</Kicker>
            <h1 id="hero-title" class="hero__title">
                <EmphasisText v-if="profile.headline" :text="profile.headline" />
                <template v-else>{{ profile.name }}</template>
            </h1>
            <div class="byline">
                <img class="byline__portrait" src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="72" height="72">
                <p class="byline__text">
                    <b class="byline__name">{{ profile.name }}</b>
                    <span v-if="profile.location" class="byline__meta">Based in {{ profile.location }}</span>
                </p>
            </div>
        </section>

        <section class="intro" aria-labelledby="intro-title">
            <h2 id="intro-title" class="visually-hidden">Introduction</h2>
            <div v-if="profile.bio?.length" class="intro__columns">
                <p v-for="(paragraph, index) in profile.bio" :key="index">{{ paragraph }}</p>
            </div>
            <FactList id="glance-title" title="At a glance" :items="facts">
                <ActionLink class="fact-list__action" href="/portfolio" variant="solid" arrow>See the portfolio</ActionLink>
            </FactList>
        </section>

        <section v-if="skillAreas.length" class="section" aria-labelledby="skills-title">
            <SectionHeading id="skills-title" numeral="i" title="Programming knowledge" compact />
            <ul class="skill-index">
                <li v-for="(area, index) in skillAreas" :key="area.id" class="skill-index__row">
                    <span class="skill-index__number" aria-hidden="true">{{ padNumber(index + 1) }}</span>
                    <h3 class="skill-index__title">{{ area.name }}</h3>
                    <p class="skill-index__skills">{{ area.skills.join(', ') }}</p>
                </li>
            </ul>
        </section>

        <section v-if="languages.length" class="section" aria-labelledby="languages-title">
            <SectionHeading id="languages-title" numeral="ii" title="Spoken languages" compact />
            <ul class="language-grid">
                <li v-for="language in languages" :key="language.id" class="language-grid__item">
                    <h3 class="language-grid__name">{{ language.name }}</h3>
                    <p class="language-grid__level">{{ languageLevel(language) }}</p>
                    <RatingDots :value="language.rating" />
                </li>
            </ul>
        </section>
    </div>
</template>
