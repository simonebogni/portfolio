<script setup lang="ts">
import type { TerrainProfile } from '@designs/terrain/entities/profile';
import { BaseButton } from '@designs/terrain/shared/ui';
import { computed } from 'vue';
import { firstNameOf, markLastWord } from '../model/headline';

/** Home hero: greeting, headline with a marked last word, bio, calls to action and the portrait. */
const props = defineProps<{
    profile: TerrainProfile;
}>();

const firstName = computed(() => firstNameOf(props.profile.name));
const headline = computed(() => markLastWord(props.profile.headline));
</script>

<template>
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero__text">
            <p class="hero__hello" lang="it">Ciao!</p>
            <h1 id="hero-title" class="hero__title">
                <template v-if="headline">
                    I’m {{ firstName }}, {{ headline.lead }}<span class="marker">{{ headline.mark }}</span>{{ headline.end }}
                </template>
                <template v-else>{{ profile.name }}</template>
            </h1>
            <p v-if="profile.bio" class="hero__bio">{{ profile.bio }}</p>
            <p class="hero__roles">{{ profile.roles.join(' · ') }}</p>
            <div class="hero__actions">
                <BaseButton href="/portfolio" icon="arrow" block>Explore my work</BaseButton>
                <BaseButton v-if="profile.email" :href="`mailto:${profile.email}`" variant="ghost" block>Say hello</BaseButton>
                <BaseButton v-else href="/experience" variant="ghost" block>See my experience</BaseButton>
            </div>
        </div>
        <div class="portrait">
            <div class="portrait__blob terrain" aria-hidden="true"></div>
            <img
                class="portrait__image"
                src="/assets/img/profile.jpg"
                :alt="`Portrait of ${profile.name}`"
                width="480"
                height="480"
            />
            <p v-if="profile.location" class="portrait__badge">
                <span>Based in</span>
                <strong>{{ profile.location }}</strong>
            </p>
        </div>
    </section>
</template>
