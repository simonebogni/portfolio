<script setup lang="ts">
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { FeatureCard, SectionHeading } from '@designs/blueprint/shared/ui';

/** "What I bring": one card per configured strength. */
const { profile, fill } = useBlueprintProfile();
</script>

<template>
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
</template>
