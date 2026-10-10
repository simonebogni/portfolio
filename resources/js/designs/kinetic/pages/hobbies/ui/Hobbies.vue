<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';
import { useProfile } from '@core/entities/profile';
import { pad2 } from '@core/shared/lib';
import type { KineticProfile } from '@designs/kinetic/entities/profile';
import { PageHeader } from '@designs/kinetic/shared/ui';
import { Head } from '@inertiajs/vue3';

/** Props of the Hobbies page (HobbyController). */
defineProps<{
    hobbies: Hobby[];
}>();

const { profile } = useProfile<KineticProfile>();
</script>

<template>
    <div class="page page--hobbies container">
        <Head title="Hobbies" />
        <PageHeader title="Off" accent="line." :intro="profile.intros?.hobbies" :ruled="false" />
        <ul class="hobby-grid plain-list">
            <li v-for="(hobby, index) in hobbies" :key="hobby.id" class="hobby-card" :class="{ 'hobby-card--accent': index % 3 === 1 }">
                <!-- The photo illustrates the title next to it, so it is decorative. -->
                <img v-if="hobby.coverImgUrl" class="hobby-card__image" :src="hobby.coverImgUrl" alt="" width="400" height="400" loading="lazy" />
                <div class="hobby-card__body">
                    <span class="hobby-card__index display" aria-hidden="true">{{ pad2(index + 1) }}</span>
                    <h2 class="hobby-card__title display">{{ hobby.title }}</h2>
                    <p class="hobby-card__text">{{ hobby.description }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>
