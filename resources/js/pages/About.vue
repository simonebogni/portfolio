<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseButton from '../components/BaseButton.vue';
import MarqueeTicker from '../components/MarqueeTicker.vue';
import RatingBlocks from '../components/RatingBlocks.vue';
import SectionHeading from '../components/SectionHeading.vue';
import StatList from '../components/StatList.vue';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
    stats: { type: Object, required: true },
});

const profile = computed(() => usePage().props.profile);

/** "Simone Bogni" → ["Simone", "Bogni."]: the last word is set in orange. */
const nameParts = computed(() => {
    const words = profile.value.name.trim().split(/\s+/);
    const last = words.pop();

    return { first: words.join(' '), last: `${last}.` };
});

const skillsOf = (category) => category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name));

/** Every skill once, without notes such as "(past)", for the scrolling band. */
const tickerItems = computed(() => [
    ...new Set(
        props.skillCategories
            .flatMap(skillsOf)
            .map((name) => name.replace(/\s*\(.*?\)\s*/g, ' ').trim())
            .filter((name) => name && name.length <= 24),
    ),
]);

const stats = computed(() =>
    [
        { value: props.stats.projects, label: 'portfolio projects' },
        { value: `${props.stats.certificates}×`, label: 'certifications', count: props.stats.certificates },
        { value: props.stats.awards, label: props.stats.awards === 1 ? 'award' : 'awards' },
        { value: props.languages.length, label: 'spoken languages' },
    ].filter((item) => (item.count ?? item.value) > 0),
);

function languageLevel(language) {
    const level = language.isNative ? 'Native' : language.speaking || language.ratingMeaning;

    return [level, language.certificateLevel].filter(Boolean).join(' · ');
}
</script>

<template>
    <div class="page page--about">
        <Head title="About" />
        <section class="container hero" aria-labelledby="hero-title">
            <ul class="hero__roles plain-list" aria-label="Roles">
                <li v-for="role in profile.roles" :key="role">{{ role }}</li>
            </ul>
            <h1 id="hero-title" class="hero__name display">
                <span v-if="nameParts.first">{{ nameParts.first }}</span>
                <span class="text-accent">{{ nameParts.last }}</span>
            </h1>
            <div class="hero__row">
                <div class="hero__photo">
                    <img src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="240" height="240">
                </div>
                <p v-if="profile.bio" class="hero__lede">{{ profile.bio }}</p>
                <BaseButton class="hero__cta" href="/portfolio">See the work</BaseButton>
            </div>
        </section>

        <MarqueeTicker v-if="tickerItems.length" :items="tickerItems" />

        <div class="container">
            <StatList :items="stats" />

            <section v-if="skillCategories.length" class="section" aria-labelledby="skills-title">
                <SectionHeading id="skills-title" title="Stack" kicker="Programming knowledge" />
                <ul class="skill-rows plain-list">
                    <li v-for="category in skillCategories" :key="category.id" class="skill-rows__item">
                        <h3 class="skill-rows__name display">{{ category.name }}</h3>
                        <p class="skill-rows__skills">{{ skillsOf(category).join(', ') }}</p>
                    </li>
                </ul>
            </section>

            <section v-if="languages.length" class="section" aria-labelledby="languages-title">
                <SectionHeading id="languages-title" title="Languages" kicker="Spoken" />
                <ul class="language-grid plain-list">
                    <li v-for="language in languages" :key="language.id" class="language-card">
                        <h3 class="language-card__name display">{{ language.name }}</h3>
                        <p class="language-card__level">{{ languageLevel(language) }}</p>
                        <RatingBlocks :value="language.rating" />
                    </li>
                </ul>
            </section>
        </div>
    </div>
</template>
