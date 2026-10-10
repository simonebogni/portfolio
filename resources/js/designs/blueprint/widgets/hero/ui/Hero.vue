<script setup lang="ts">
import { emphasisSegments } from '@core/shared/lib';
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { AppButton, TagLabel } from '@designs/blueprint/shared/ui';
import { computed } from 'vue';
import CollaborationMap from './CollaborationMap.vue';

/** The home page hero: role tag, headline with highlighted words, intro, actions and the "How I work" diagram. */
const { profile, teamSize, contact, fill } = useBlueprintProfile();

const headline = computed(() => emphasisSegments(fill(profile.value.headline)));
</script>

<template>
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
</template>
