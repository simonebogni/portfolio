<script setup>
import { Head } from '@inertiajs/vue3';
import PageHeader from '../components/PageHeader.vue';
import { useProfile } from '../composables/useProfile';

defineProps({
    hobbies: { type: Array, required: true },
});

const { profile, fill } = useProfile();

function notes(hobby) {
    return profile.value.hobby_notes?.[hobby.title] ?? {};
}
</script>

<template>
    <div class="page page--hobbies">
        <Head title="Hobbies" />
        <PageHeader tag="Hobbies" title="Off the clock" :intro="fill(profile.page_intros.hobbies)" />

        <div class="container">
            <ul class="card-grid card-grid--3 hobbies">
                <li v-for="hobby in hobbies" :key="hobby.id" class="hobby">
                    <img
                        v-if="hobby.coverImgUrl"
                        class="hobby__image"
                        :src="hobby.coverImgUrl"
                        alt=""
                        width="400"
                        height="230"
                        loading="lazy"
                    >
                    <div class="hobby__body">
                        <span v-if="notes(hobby).kind" class="kicker">{{ notes(hobby).kind }}</span>
                        <h2 class="hobby__title">{{ hobby.title }}</h2>
                        <p>{{ hobby.description }}</p>
                        <p v-if="notes(hobby).lesson" class="hobby__lesson">
                            <b>What it teaches</b>{{ notes(hobby).lesson }}
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
