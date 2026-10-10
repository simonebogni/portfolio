<script setup lang="ts">
import { pad2 } from '@core/shared/lib';
import { type WorkingStep, useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { ChipList, SectionHeading } from '@designs/blueprint/shared/ui';

/** "Working model": the numbered steps from idea to release, with the people involved in each. */
defineProps<{
    steps: readonly WorkingStep[];
}>();

const { fill } = useBlueprintProfile();
</script>

<template>
    <section v-if="steps.length" class="section" aria-labelledby="flow-title">
        <SectionHeading id="flow-title" kicker="01 · Working model" title="From idea to release, together" />
        <ol class="flow">
            <li v-for="(step, index) in steps" :key="step.phase" class="flow__step">
                <span class="flow__number">{{ pad2(index + 1) }} / {{ step.phase }}</span>
                <h3 class="flow__title">{{ step.title }}</h3>
                <p>{{ fill(step.text) }}</p>
                <ChipList :items="step.people ?? []" label="People involved" variant="soft" />
            </li>
        </ol>
    </section>
</template>
