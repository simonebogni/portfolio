<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageHeader from '../components/PageHeader.vue';
import StoryBlock from '../components/StoryBlock.vue';
import { pageKicker } from '../composables/useNavigation';
import { toRoman } from '../lib/format';

defineProps({
    hobbies: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
</script>

<template>
    <div class="page page--hobbies">
        <Head title="Hobbies" />
        <PageHeader :kicker="pageKicker('Hobbies')" :lede="profile.intros?.hobbies">Off the clock</PageHeader>
        <ul v-if="hobbies.length" class="story-list">
            <li v-for="(hobby, index) in hobbies" :key="hobby.id">
                <!-- The photos illustrate the title next to them, so they are decorative (empty alt). -->
                <StoryBlock
                    :numeral="toRoman(index + 1)"
                    :title="hobby.title"
                    :text="hobby.description"
                    :image-url="hobby.coverImgUrl || ''"
                    :flip="index % 2 === 1"
                />
            </li>
        </ul>
    </div>
</template>
