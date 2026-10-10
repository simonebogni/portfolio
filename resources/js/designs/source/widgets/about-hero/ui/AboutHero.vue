<script setup lang="ts">
import type { SkillCategory } from '@core/entities/skill';
import { firstName, useSourceProfile } from '@designs/source/entities/profile';
import { AppButton, AppIcon, CodeWindow } from '@designs/source/shared/ui';
import { computed } from 'vue';
import { profileCodeLines } from '../model/codeLines';

/** The home page hero: name, roles, bio and calls to action, next to the profile written as code. */
const props = withDefaults(defineProps<{ skillCategories: readonly SkillCategory[]; languages: number; education?: string | null }>(), {
    education: null,
});

const { profile } = useSourceProfile();
const variable = computed(() => firstName(profile.value.name).toLowerCase());
const role = computed(() => profile.value.current_role?.title || profile.value.roles[0] || '');

const codeLines = computed(() =>
    profileCodeLines({
        variable: variable.value,
        role: role.value,
        location: profile.value.location,
        skillCategories: props.skillCategories,
        languages: props.languages,
    }),
);
</script>

<template>
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
                <li v-if="education"><AppIcon name="cap" :size="16" />{{ education }}</li>
            </ul>
        </div>
        <CodeWindow :filename="`${variable}.ts`" :lines="codeLines" :label="`Profile summary of ${profile.name}, written as code`">
            <img class="avatar" src="/assets/img/profile.jpg" :alt="`Portrait of ${profile.name}`" width="56" height="56" />
            <span>
                <strong>{{ profile.name }}</strong>
                <small v-if="profile.tagline">{{ profile.tagline }}</small>
            </span>
        </CodeWindow>
    </section>
</template>
