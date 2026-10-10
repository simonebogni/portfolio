<script setup>
import { Head } from '@inertiajs/vue3';
import BentoGrid from '../components/BentoGrid.vue';
import BentoTile from '../components/BentoTile.vue';
import Icon from '../components/Icon.vue';
import PageIntro from '../components/PageIntro.vue';

const props = defineProps({
    softSkills: { type: Array, required: true },
});

/** Decorative icons, picked by keyword in the skill name, then by position. */
const iconRules = [
    [/learn/i, 'cap'],
    [/problem|solv|analy/i, 'search'],
    [/responsib|ownership/i, 'shield'],
    [/team|collab/i, 'people'],
    [/manag|autonom/i, 'clock'],
    [/adapt/i, 'cycle'],
    [/open|mind/i, 'eye'],
    [/flexib/i, 'wave'],
];
const fallbackIcons = ['spark', 'cap', 'search', 'shield', 'people', 'clock', 'cycle', 'eye', 'wave'];

function iconFor(skill, index) {
    return iconRules.find(([pattern]) => pattern.test(skill.name))?.[1] ?? fallbackIcons[index % fallbackIcons.length];
}

/** First tile sits beside the header, the next three fill a row of thirds, the rest go in halves. */
function spanFor(index) {
    if (index < 4) {
        return 4;
    }

    const rest = props.softSkills.length - 4;
    const isLastOdd = rest % 2 === 1 && index === props.softSkills.length - 1;

    return isLastOdd ? 12 : 6;
}
</script>

<template>
    <div class="page page-softskills">
        <Head title="Soft skills" />
        <BentoGrid as="div">
            <PageIntro
                :span="8"
                class="intro--bottom"
                title="Soft skills"
                lead="The habits I bring to every project, from the first analysis to the release."
            />
            <BentoTile
                v-for="(skill, index) in softSkills"
                :key="skill.id"
                as="section"
                :span="spanFor(index)"
                :tone="index === 0 ? 'inverse' : 'surface'"
                class="skill"
                :aria-labelledby="`skill-${skill.id}`"
            >
                <span class="skill__icon" aria-hidden="true"><Icon :name="iconFor(skill, index)" :size="24" /></span>
                <h2 :id="`skill-${skill.id}`" class="tile-title tile-title--sm">{{ skill.name }}</h2>
                <p>{{ skill.description }}</p>
            </BentoTile>
        </BentoGrid>
    </div>
</template>
