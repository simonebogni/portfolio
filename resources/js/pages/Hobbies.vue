<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseCard from '../components/BaseCard.vue';
import PageHeader from '../components/PageHeader.vue';
import { slugify } from '../lib/format';

defineProps({
    hobbies: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
</script>

<template>
    <div class="page page-hobbies">
        <Head title="Hobbies" />
        <PageHeader eyebrow="// while (!coding) { … }" title="Hobbies" :intro="profile.intros?.hobbies" />
        <ul class="card-grid card-grid--3 bare-list">
            <BaseCard v-for="hobby in hobbies" :key="hobby.id" as="li" padding="none" class="hobby">
                <!-- Decorative: the heading below names the picture's subject. -->
                <img v-if="hobby.coverImgUrl" class="hobby__photo" :src="hobby.coverImgUrl" alt="" width="400" height="240" loading="lazy" decoding="async">
                <div class="hobby__body">
                    <span class="hobby__file" aria-hidden="true">{{ slugify(hobby.title) }}.md</span>
                    <h2 class="hobby__title">{{ hobby.title }}</h2>
                    <p class="card-text">{{ hobby.description }}</p>
                </div>
            </BaseCard>
        </ul>
    </div>
</template>
