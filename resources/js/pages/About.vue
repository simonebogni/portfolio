<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    languages: { type: Array, required: true },
    skillCategories: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
</script>

<template>
    <div class="page">
        <Head title="About" />
        <section aria-labelledby="hero-title">
            <h1 id="hero-title">{{ profile.name }}</h1>
            <p>{{ profile.roles.join(' · ') }} · {{ profile.location }}</p>
        </section>
        <section aria-labelledby="skills-title">
            <h2 id="skills-title">Programming knowledge</h2>
            <article v-for="category in skillCategories" :key="category.id">
                <h3>{{ category.name }}</h3>
                <ul class="inline-list">
                    <template v-for="subcategory in category.subcategories" :key="subcategory.id">
                        <li v-for="skill in subcategory.skills" :key="skill.id">{{ skill.name }}</li>
                    </template>
                </ul>
            </article>
        </section>
        <section aria-labelledby="languages-title">
            <h2 id="languages-title">Spoken languages</h2>
            <ul>
                <li v-for="language in languages" :key="language.id">
                    <strong>{{ language.name }}</strong> — {{ language.isNative ? 'Native' : language.ratingMeaning }}
                    <span v-if="language.certificateLevel"> · {{ language.certificateLevel }}</span>
                </li>
            </ul>
        </section>
    </div>
</template>
