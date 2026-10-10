<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import FilterGroup from '../components/FilterGroup.vue';
import PageHeader from '../components/PageHeader.vue';
import ProjectFeature from '../components/ProjectFeature.vue';
import ProjectRow from '../components/ProjectRow.vue';

const props = defineProps({
    categories: { type: Array, required: true },
});

const profile = computed(() => usePage().props.profile);
const ALL = 'all';
const selected = ref(ALL);

const allItems = computed(() => props.categories.flatMap((category) => category.items.map((item) => ({ item, category: category.title }))));

const options = computed(() => [
    { value: ALL, label: 'All', count: allItems.value.length },
    ...props.categories.map((category) => ({ value: category.id, label: category.title, count: category.items.length })),
]);

const visible = computed(() =>
    selected.value === ALL
        ? allItems.value
        : (props.categories.find((category) => category.id === selected.value)?.items ?? []).map((item) => ({
              item,
              category: props.categories.find((category) => category.id === selected.value).title,
          })),
);

const featured = computed(() => visible.value[0] ?? null);

const status = computed(() => {
    const count = visible.value.length;
    const noun = count === 1 ? 'project' : 'projects';
    const option = options.value.find((entry) => entry.value === selected.value);

    return selected.value === ALL ? `Showing all ${count} ${noun}` : `Showing ${count} ${noun} in ${option?.label}`;
});
</script>

<template>
    <div class="page page--portfolio container">
        <Head title="Portfolio" />
        <PageHeader title="Wo" accent="rk." :intro="profile.intros?.portfolio" size="2xl" layout="split" :ruled="false" />

        <template v-if="allItems.length">
            <FilterGroup v-model="selected" :options="options" label="Filter projects by category" :status="status" />

            <ProjectFeature v-if="featured" :key="featured.item.id" :item="featured.item" :category="featured.category" :index="1" />

            <h2 class="visually-hidden" id="index-title">All projects</h2>
            <ol class="project-index plain-list" aria-labelledby="index-title">
                <ProjectRow
                    v-for="(entry, index) in visible"
                    :key="entry.item.id"
                    :item="entry.item"
                    :category="entry.category"
                    :index="index + 1"
                />
            </ol>
        </template>
        <p v-else class="empty-state">No projects to show yet.</p>
    </div>
</template>
