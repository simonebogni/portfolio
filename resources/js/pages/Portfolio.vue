<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    categories: { type: Array, required: true },
});
</script>

<template>
    <div class="page">
        <Head title="Portfolio" />
        <h1>Portfolio</h1>
        <section v-for="category in categories" :key="category.id" :aria-labelledby="`category-${category.id}`">
            <h2 :id="`category-${category.id}`">{{ category.title }}</h2>
            <article v-for="item in category.items" :key="item.id">
                <h3>{{ item.title }}</h3>
                <p v-if="item.subtitle">{{ item.subtitle }}</p>
                <p>{{ item.description }}</p>
                <ul class="inline-list">
                    <li v-if="item.liveUrl"><a :href="item.liveUrl">Live site<span class="visually-hidden"> of {{ item.title }}</span></a></li>
                    <li v-if="item.gitRepoUrl"><a :href="item.gitRepoUrl">Source code<span class="visually-hidden"> of {{ item.title }}</span></a></li>
                </ul>
            </article>
        </section>
    </div>
</template>
