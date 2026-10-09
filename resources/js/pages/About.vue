<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppButton from '../components/AppButton.vue';
import CollaborationMap from '../components/CollaborationMap.vue';
import FeatureCard from '../components/FeatureCard.vue';
import SectionHeading from '../components/SectionHeading.vue';
import StatStrip from '../components/StatStrip.vue';
import TagLabel from '../components/TagLabel.vue';
import { useProfile } from '../composables/useProfile';
import { emphasisSegments } from '../lib/profile';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
    highlights: { type: Object, required: true },
});

const { profile, teamSize, contact, fill } = useProfile();

const headline = computed(() => emphasisSegments(fill(profile.value.headline)));

const stats = computed(() => [
    { value: teamSize.value > 0 ? teamSize.value : null, label: 'Developers led' },
    { value: props.highlights.firstWorkYear, label: 'Writing software since' },
    { value: props.highlights.portfolioProjects || null, label: 'Portfolio projects' },
    { value: props.languages.length || null, label: 'Spoken languages' },
]);

/** Each category's skills, as one line. */
function skillLine(category) {
    return category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)).join(', ');
}

function languageLevel(language) {
    const level = language.isNative ? 'Native' : language.speaking || language.ratingMeaning;

    return [level, language.certificateLevel].filter(Boolean).join(' · ');
}
</script>

<template>
    <div class="page page--about">
        <Head title="About" />
        <section class="hero blueprint-grid" aria-labelledby="hero-title">
            <div class="container hero__inner">
                <div class="hero__copy">
                    <TagLabel dot>{{ profile.current_role.title }} · {{ profile.location }}</TagLabel>
                    <h1 id="hero-title" class="hero__title">
                        <template v-for="(segment, index) in headline" :key="index">
                            <em v-if="segment.em">{{ segment.text }}</em>
                            <template v-else>{{ segment.text }}</template>
                        </template>
                    </h1>
                    <p v-if="profile.intro" class="lede">{{ fill(profile.intro) }}</p>
                    <div class="button-row">
                        <AppButton href="/portfolio">Read the case studies</AppButton>
                        <AppButton v-if="contact" :href="contact.href" variant="ghost">{{ contact.short }}</AppButton>
                    </div>
                </div>
                <CollaborationMap
                    :partners="profile.collaboration.partners"
                    :lead-name="profile.name"
                    :lead-title="profile.current_role.title"
                    :lead-focus="profile.collaboration.lead_focus"
                    :team-size="teamSize"
                    portrait="/assets/img/profile.jpg"
                />
            </div>
        </section>

        <StatStrip :items="stats" />

        <div class="container">
            <section v-if="profile.strengths.length" class="section" aria-labelledby="bring-title">
                <SectionHeading id="bring-title" kicker="01 · What I bring" title="Engineer, lead and product partner, in one role." />
                <ul class="card-grid card-grid--3">
                    <li v-for="strength in profile.strengths" :key="strength.title">
                        <FeatureCard :icon="strength.icon" :title="strength.title">
                            <p>{{ fill(strength.text) }}</p>
                        </FeatureCard>
                    </li>
                </ul>
            </section>

            <section v-if="skillCategories.length" class="section" aria-labelledby="stack-title">
                <SectionHeading id="stack-title" kicker="02 · Toolbox" title="Programming knowledge" />
                <ul class="stack">
                    <li v-for="category in skillCategories" :key="category.id" class="stack__item">
                        <h3 class="kicker">{{ category.name }}</h3>
                        <p>{{ skillLine(category) }}</p>
                    </li>
                </ul>
            </section>

            <section v-if="languages.length" class="section" aria-labelledby="langs-title">
                <SectionHeading id="langs-title" kicker="03 · Communication" title="Languages" />
                <ul class="languages">
                    <li v-for="language in languages" :key="language.id" class="languages__item">
                        <b>{{ language.name }}</b>
                        <span>{{ languageLevel(language) }}</span>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</template>
