<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import ActionLink from '../components/ActionLink.vue';
import DefinitionRows from '../components/DefinitionRows.vue';
import EmphasisText from '../components/EmphasisText.vue';
import Eyebrow from '../components/Eyebrow.vue';
import NumberedList from '../components/NumberedList.vue';
import PillarList from '../components/PillarList.vue';
import PortraitFigure from '../components/PortraitFigure.vue';
import SectionHeading from '../components/SectionHeading.vue';
import TestimonialCard from '../components/TestimonialCard.vue';
import { useProfile } from '../composables/useProfile';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
});

const { profile, fill } = useProfile();

const teamSize = computed(() => profile.value.current_role?.team_size);
const copy = computed(() => profile.value.copy ?? {});

const fillItems = (items) => (items ?? []).map((item) => ({ ...item, title: fill(item.title), text: fill(item.text) }));
const leadershipRoles = computed(() => fillItems(profile.value.leadership_roles));
const principles = computed(() => fillItems(profile.value.principles));
const testimonials = computed(() => profile.value.testimonials ?? []);

const portraitCaption = computed(() =>
    [teamSize.value ? 'developers in my team' : '', profile.value.location].filter(Boolean).join(' · '),
);

const skills = computed(() =>
    props.skillCategories
        .map((category) => ({
            term: category.name,
            detail: category.subcategories.flatMap((subcategory) => subcategory.skills.map((skill) => skill.name)).join(', '),
        }))
        .filter((row) => row.detail),
);

const spokenLanguages = computed(() =>
    props.languages.map((language) => ({
        term: language.name,
        detail: [language.isNative ? 'Native' : language.ratingMeaning, language.certificateLevel].filter(Boolean).join(' · '),
    })),
);
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <div class="wrap">
            <section class="hero" aria-labelledby="hero-title">
                <div class="hero__text">
                    <Eyebrow>{{ profile.roles.join(' · ') }}</Eyebrow>
                    <h1 id="hero-title" class="hero__title">
                        <span class="visually-hidden">{{ profile.name }}: </span><EmphasisText :text="fill(copy.headline)" />
                    </h1>
                    <p class="hero__lede">{{ fill(copy.intro) }}</p>
                    <div class="hero__actions">
                        <ActionLink href="/portfolio">See selected work</ActionLink>
                        <ActionLink v-if="profile.email" :href="`mailto:${profile.email}`" variant="text">Start a conversation</ActionLink>
                        <ActionLink v-else href="/experience" variant="text">Read my experience</ActionLink>
                    </div>
                </div>
                <PortraitFigure
                    src="/assets/img/profile.jpg"
                    :alt="`Portrait of ${profile.name}`"
                    :figure="teamSize || ''"
                    :caption="portraitCaption"
                />
            </section>

            <section v-if="leadershipRoles.length" class="section section--flush" aria-labelledby="roles-title">
                <SectionHeading id="roles-title" title="Three roles, one person." kicker="What I bring" />
                <PillarList :items="leadershipRoles" />
            </section>
        </div>

        <section v-if="principles.length" class="band tone-deep" aria-labelledby="principles-title">
            <div class="wrap">
                <Eyebrow tone="deep">Operating principles</Eyebrow>
                <h2 id="principles-title" class="band__title">How I lead teams and projects.</h2>
                <NumberedList :items="principles" tone="deep" />
            </div>
        </section>

        <div class="wrap">
            <section v-if="testimonials.length" class="section" aria-labelledby="testimonials-title">
                <SectionHeading id="testimonials-title" title="What partners say." kicker="Testimonials" />
                <ul class="testimonial-grid">
                    <li v-for="(testimonial, index) in testimonials" :key="index">
                        <TestimonialCard v-bind="testimonial" />
                    </li>
                </ul>
            </section>

            <section class="section" aria-labelledby="toolkit-title">
                <SectionHeading id="toolkit-title" title="Toolkit and languages." kicker="Hands-on" />
                <div class="split">
                    <div>
                        <h3 id="skills-title" class="split__title">Programming knowledge</h3>
                        <DefinitionRows :items="skills" aria-labelledby="skills-title" />
                    </div>
                    <div>
                        <h3 id="languages-title" class="split__title">Spoken languages</h3>
                        <DefinitionRows :items="spokenLanguages" aria-labelledby="languages-title" />
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
