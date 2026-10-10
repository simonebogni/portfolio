<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';
import { HobbyCard } from '@designs/source/entities/hobby';
import { useSourceProfile } from '@designs/source/entities/profile';
import { PageHeader } from '@designs/source/shared/ui';
import { Head } from '@inertiajs/vue3';

defineProps<{ hobbies: Hobby[] }>();

const { profile } = useSourceProfile();
</script>

<template>
    <div class="page page-hobbies">
        <Head title="Hobbies" />
        <PageHeader eyebrow="// while (!coding) { … }" title="Hobbies" :intro="profile.intros?.hobbies" />
        <ul class="card-grid card-grid--3 bare-list">
            <HobbyCard v-for="hobby in hobbies" :key="hobby.id" :hobby="hobby" />
        </ul>
    </div>
</template>
