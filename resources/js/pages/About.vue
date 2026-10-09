<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppButton from '../components/AppButton.vue';
import AppIcon from '../components/AppIcon.vue';
import BaseCard from '../components/BaseCard.vue';
import ChipList from '../components/ChipList.vue';
import CodeWindow from '../components/CodeWindow.vue';
import RatingBar from '../components/RatingBar.vue';
import SectionHeading from '../components/SectionHeading.vue';
import StatList from '../components/StatList.vue';

const props = defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
    highlights: { type: Object, required: true },
});

const profile = computed(() => usePage().props.profile);
const firstName = computed(() => profile.value.name.trim().split(/\s+/)[0]);
const role = computed(() => profile.value.current_role?.title || profile.value.roles[0]);

// The hero "source file" is generated from the real profile and skills.
const codeLines = computed(() => {
    const variable = firstName.value.toLowerCase();
    const stack = props.skillCategories
        .map((category) => category.name)
        .filter((name) => name.toLowerCase() !== 'more')
        .slice(0, 3);
    const str = (text) => ({ text: `"${text}"`, kind: 'string' });
    const plain = (text) => ({ text });

    const stackTokens = stack.flatMap((name, index) => (index === 0 ? [str(name)] : [plain(', '), str(name)]));

    return [
        [{ text: 'const', kind: 'keyword' }, plain(` ${variable} = {`)],
        [plain('  role: '), str(role.value), plain(',')],
        [plain('  stack: ['), ...stackTokens, plain('],')],
        ...(profile.value.location ? [[plain('  based: '), str(profile.value.location), plain(',')]] : []),
        [plain('  languages: '), { text: String(props.languages.length), kind: 'literal' }, plain(',')],
        [plain('  learning: '), { text: 'Infinity', kind: 'literal' }, plain(',')],
        [plain('};')],
    ];
});

const stats = computed(() => {
    const { certificates, certificateIssuer, latestAward, projects } = props.highlights;
    const items = [];

    if (certificates > 0) {
        items.push({ value: String(certificates), label: certificateIssuer ? `${certificateIssuer} certifications` : 'certifications' });
    }

    if (latestAward) {
        items.push({ value: latestAward.year ?? 'Award', label: latestAward.title });
    }

    if (projects > 0) {
        items.push({ value: String(projects), label: 'portfolio projects' });
    }

    if (props.languages.length > 0) {
        items.push({ value: String(props.languages.length), label: 'spoken languages' });
    }

    return items;
});

function skillCount(category) {
    return category.subcategories.reduce((total, subcategory) => total + subcategory.skills.length, 0);
}
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero__intro">
                <p class="eyebrow" aria-hidden="true">// hello, world</p>
                <h1 id="hero-title" class="hero__title">{{ profile.name }}</h1>
                <p class="hero__role">{{ profile.roles.join(' · ') }}</p>
                <p v-if="profile.bio" class="hero__lede">{{ profile.bio }}</p>
                <div class="btn-row btn-row--stack hero__ctas">
                    <AppButton href="/portfolio" icon="arrowRight">View my work</AppButton>
                    <AppButton v-if="profile.email" :href="`mailto:${profile.email}`" variant="ghost">Get in touch</AppButton>
                    <AppButton v-else href="/experience" variant="ghost">Read my experience</AppButton>
                </div>
                <ul class="hero__meta bare-list">
                    <li v-if="profile.location"><AppIcon name="pin" :size="16" />{{ profile.location }}</li>
                    <li v-if="highlights.education"><AppIcon name="cap" :size="16" />{{ highlights.education }}</li>
                </ul>
            </div>
            <CodeWindow :filename="`${firstName.toLowerCase()}.ts`" :lines="codeLines" :label="`Profile summary of ${profile.name}, written as code`">
                <img class="avatar" src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="56" height="56">
                <span>
                    <strong>{{ profile.name }}</strong>
                    <small v-if="profile.tagline">{{ profile.tagline }}</small>
                </span>
            </CodeWindow>
        </section>

        <StatList :items="stats" />

        <section class="block" aria-labelledby="skills-title">
            <SectionHeading id="skills-title" title="Programming knowledge" comment="tools I reach for" />
            <ul class="skill-grid bare-list">
                <BaseCard v-for="category in skillCategories" :key="category.id" as="li" class="skill-card">
                    <h3 class="skill-card__title">{{ category.name }}</h3>
                    <p class="skill-card__count">{{ skillCount(category) }} skills</p>
                    <dl class="skill-card__groups">
                        <div v-for="subcategory in category.subcategories" :key="subcategory.id" class="skill-card__group">
                            <dt>{{ subcategory.name }}</dt>
                            <dd><ChipList :items="subcategory.skills.map((skill) => skill.name)" :label="`${category.name}: ${subcategory.name}`" /></dd>
                        </div>
                    </dl>
                </BaseCard>
            </ul>
        </section>

        <section aria-labelledby="languages-title">
            <SectionHeading id="languages-title" title="Spoken languages" comment="i18n ready" />
            <ul class="language-grid bare-list">
                <BaseCard v-for="language in languages" :key="language.id" as="li" class="language">
                    <h3 class="language__name">{{ language.name }}</h3>
                    <p class="language__level">{{ language.isNative ? 'Native' : language.ratingMeaning }}</p>
                    <RatingBar :value="language.rating" />
                    <p v-if="language.certificateLevel" class="language__cert">
                        <span class="visually-hidden">Certificate: </span>{{ language.certificateLevel }}
                    </p>
                </BaseCard>
            </ul>
        </section>
    </div>
</template>
