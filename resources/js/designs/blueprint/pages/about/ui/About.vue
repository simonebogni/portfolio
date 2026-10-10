<script setup lang="ts">
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { StatStrip } from '@designs/blueprint/shared/ui';
import { Hero } from '@designs/blueprint/widgets/hero';
import { Languages } from '@designs/blueprint/widgets/languages';
import { Strengths } from '@designs/blueprint/widgets/strengths';
import { Toolbox } from '@designs/blueprint/widgets/toolbox';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { aboutStats } from '../model/stats';
import type { AboutProps } from '../model/types';

const props = defineProps<AboutProps>();

const { teamSize } = useBlueprintProfile();

const stats = computed(() => aboutStats(teamSize.value, props.highlights, props.languages.length));
</script>

<template>
    <div class="page page--about">
        <Head title="About" />
        <Hero />

        <StatStrip :items="stats" />

        <div class="container">
            <Strengths />
            <Toolbox :skill-categories="skillCategories" />
            <Languages :languages="languages" />
        </div>
    </div>
</template>
