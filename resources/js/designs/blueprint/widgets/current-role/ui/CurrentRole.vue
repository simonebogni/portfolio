<script setup lang="ts">
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { DraftText, SectionHeading, SpecList } from '@designs/blueprint/shared/ui';
import { computed } from 'vue';
import { roleScope, roleSince } from '../model/role';

/** "Current role": since when, title, company, summary and outcomes, with the role scope on an inverted panel. */
const { profile, teamSize, fill } = useBlueprintProfile();
const role = computed(() => profile.value.current_role);
const since = computed(() => roleSince(role.value.since));
const scope = computed(() => roleScope(role.value, teamSize.value));
</script>

<template>
    <section v-if="role.title" class="section" aria-labelledby="now-title">
        <SectionHeading id="now-title" kicker="01 · Current role" title="Leading engineering" />
        <article class="current-role">
            <div class="current-role__main">
                <span v-if="since" class="when"><DraftText :text="since" /> – present</span>
                <h3 class="current-role__title">{{ role.title }}</h3>
                <p class="current-role__org">
                    <template v-if="role.company"><DraftText :text="role.company" /> · </template>{{ profile.location }}
                </p>
                <p v-if="role.summary">{{ fill(role.summary) }}</p>
                <DraftText v-for="outcome in role.outcomes" :key="outcome" as="p" :text="fill(outcome)" />
            </div>
            <div class="current-role__scope">
                <h4 class="visually-hidden">Role scope</h4>
                <SpecList :items="scope" variant="block" />
            </div>
        </article>
    </section>
</template>
