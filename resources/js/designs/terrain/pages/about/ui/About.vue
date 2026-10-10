<script setup lang="ts">
import { useTerrainProfile } from '@designs/terrain/entities/profile';
import { StatStrip } from '@designs/terrain/shared/ui';
import { AboutHero } from '@designs/terrain/widgets/about-hero';
import { LanguageList } from '@designs/terrain/widgets/language-list';
import { SkillToolbox } from '@designs/terrain/widgets/skill-toolbox';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import type { AboutProps } from '../model/props';
import { highlightStats } from '../model/stats';

const props = defineProps<AboutProps>();

const { profile } = useTerrainProfile();

const stats = computed(() => highlightStats(props.highlights, props.languages.length));
</script>

<template>
    <div class="page page-about">
        <Head title="About" />
        <AboutHero :profile="profile" />

        <StatStrip v-if="stats.length" class="page-about__stats" :items="stats" />

        <SkillToolbox :categories="skillCategories" />

        <LanguageList :languages="languages" />
    </div>
</template>
