<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageHeader from '../components/PageHeader.vue';
import { pageKicker } from '../composables/useNavigation';
import { padNumber } from '../lib/format';

defineProps({
    softSkills: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
</script>

<template>
    <div class="page page--soft-skills">
        <Head title="Soft skills" />
        <PageHeader :kicker="pageKicker('SoftSkills')" :lede="profile.intros?.soft_skills" lede-style="standfirst" ruled>
            How I work
        </PageHeader>
        <ol v-if="softSkills.length" class="numbered-grid">
            <li v-for="(skill, index) in softSkills" :key="skill.id" class="numbered-grid__item">
                <span class="numbered-grid__number" aria-hidden="true">{{ padNumber(index + 1) }}</span>
                <div>
                    <h2 class="numbered-grid__title">{{ skill.name }}</h2>
                    <p v-if="skill.description" class="numbered-grid__text">{{ skill.description }}</p>
                </div>
            </li>
        </ol>
    </div>
</template>
