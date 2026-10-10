<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';
import { type HobbyNote, useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { HobbyCard } from '@designs/blueprint/entities/hobby';
import { PageHeader } from '@designs/blueprint/shared/ui';
import { Head } from '@inertiajs/vue3';

defineProps<{
    hobbies: Hobby[];
}>();

const { profile, fill } = useBlueprintProfile();

/** The configured notes for a hobby (matched by title). */
function notes(hobby: Hobby): HobbyNote {
    return profile.value.hobby_notes?.[hobby.title] ?? {};
}
</script>

<template>
    <div class="page page--hobbies">
        <Head title="Hobbies" />
        <PageHeader tag="Hobbies" title="Off the clock" :intro="fill(profile.page_intros.hobbies)" />

        <div class="container">
            <ul class="card-grid card-grid--3 hobbies">
                <HobbyCard
                    v-for="hobby in hobbies"
                    :key="hobby.id"
                    :hobby="hobby"
                    :kind="notes(hobby).kind"
                    :lesson="notes(hobby).lesson"
                />
            </ul>
        </div>
    </div>
</template>
