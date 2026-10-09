<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import NumberedList from '../components/NumberedList.vue';
import PageHeader from '../components/PageHeader.vue';
import { useProfile } from '../composables/useProfile';

const props = defineProps({
    softSkills: { type: Array, required: true },
});

const { profile } = useProfile();

/** Skills ordered by their group (config profile.soft_skill_groups); ungrouped skills keep their order at the end. */
const items = computed(() => {
    const groups = profile.value.soft_skill_groups ?? {};
    const order = [...new Set(Object.values(groups))];
    const rank = (skill) => (groups[skill.name] ? order.indexOf(groups[skill.name]) : order.length);

    return props.softSkills
        .map((skill, index) => ({ skill, index }))
        .sort((a, b) => rank(a.skill) - rank(b.skill) || a.index - b.index)
        .map(({ skill }) => ({ title: skill.name, text: skill.description, label: groups[skill.name] ?? '' }));
});

const quote = computed(() => {
    const wanted = profile.value.soft_skill_quote;

    return (props.softSkills.find((skill) => skill.name === wanted) ?? props.softSkills[0])?.description ?? '';
});
</script>

<template>
    <div class="page page-softskills wrap">
        <Head title="Soft skills" />
        <PageHeader eyebrow="Principles · Soft skills" title="The way I lead, build and collaborate.">
            <template #lede>
                <blockquote v-if="quote" class="pull-quote">
                    <p>“{{ quote }}”</p>
                </blockquote>
            </template>
        </PageHeader>
        <NumberedList :items="items" variant="wide" :heading-level="2" />
    </div>
</template>
