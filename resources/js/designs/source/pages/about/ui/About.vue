<script setup lang="ts">
import { LanguageCard } from '@designs/source/entities/language';
import { SkillCard } from '@designs/source/entities/skill';
import { SectionHeading, StatList } from '@designs/source/shared/ui';
import { AboutHero } from '@designs/source/widgets/about-hero';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { highlightStats } from '../model/stats';
import type { AboutProps } from '../model/types';

const props = defineProps<AboutProps>();

const stats = computed(() => highlightStats(props.highlights, props.languages.length));
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <AboutHero :skill-categories="skillCategories" :languages="languages.length" :education="highlights.education" />

        <StatList :items="stats" />

        <section class="block" aria-labelledby="skills-title">
            <SectionHeading id="skills-title" title="Programming knowledge" comment="tools I reach for" />
            <ul class="skill-grid bare-list">
                <SkillCard v-for="category in skillCategories" :key="category.id" :category="category" />
            </ul>
        </section>

        <section aria-labelledby="languages-title">
            <SectionHeading id="languages-title" title="Spoken languages" comment="i18n ready" />
            <ul class="language-grid bare-list">
                <LanguageCard v-for="language in languages" :key="language.id" :language="language" />
            </ul>
        </section>
    </div>
</template>
