<script setup lang="ts">
import { useProfile } from '@core/entities/profile';
import { LanguageList } from '@designs/kinetic/entities/language';
import { type KineticProfile, nameParts } from '@designs/kinetic/entities/profile';
import { BaseButton, MarqueeTicker, SectionHeading, StatList } from '@designs/kinetic/shared/ui';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { highlights, skillsOf, tickerItems } from '../model/highlights';
import type { AboutProps } from '../model/types';

const props = defineProps<AboutProps>();

const { profile } = useProfile<KineticProfile>();

/** "Simone Bogni" → ["Simone", "Bogni."]: the last word is set in orange. */
const name = computed(() => nameParts(profile.value.name));

const ticker = computed(() => tickerItems(props.skillCategories));
const stats = computed(() => highlights(props.stats, props.languages.length));
</script>

<template>
    <div class="page page--about">
        <Head title="About" />
        <section class="container hero" aria-labelledby="hero-title">
            <ul class="hero__roles plain-list" aria-label="Roles">
                <li v-for="role in profile.roles" :key="role">{{ role }}</li>
            </ul>
            <h1 id="hero-title" class="hero__name display">
                <span v-if="name.first">{{ name.first }}</span>
                <span class="text-accent">{{ name.last }}</span>
            </h1>
            <div class="hero__row">
                <div class="hero__photo">
                    <img src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="240" height="240" />
                </div>
                <p v-if="profile.bio" class="hero__lede">{{ profile.bio }}</p>
                <BaseButton class="hero__cta" href="/portfolio">See the work</BaseButton>
            </div>
        </section>

        <MarqueeTicker v-if="ticker.length" :items="ticker" />

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
                <LanguageList :languages="languages" />
            </section>
        </div>
    </div>
</template>
