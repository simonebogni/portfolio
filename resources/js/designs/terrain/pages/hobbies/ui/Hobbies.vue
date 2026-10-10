<script setup lang="ts">
import { HobbyItem } from '@designs/terrain/entities/hobby';
import { PageHeader } from '@designs/terrain/shared/ui';
import { Head } from '@inertiajs/vue3';
import type { HobbiesProps } from '../model/props';

defineProps<HobbiesProps>();
</script>

<template>
    <div class="page page-hobbies">
        <Head title="Hobbies" />
        <PageHeader eyebrow="Life outside the IDE" title="Hobbies" intro="What I do when the laptop is closed." />
        <ul class="hobbies plain-list">
            <HobbyItem v-for="(hobby, index) in hobbies" :key="hobby.id" :hobby="hobby" :index="index" />
        </ul>
    </div>
</template>
