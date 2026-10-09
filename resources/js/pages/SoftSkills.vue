<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import ChipList from '../components/ChipList.vue';
import PageHeader from '../components/PageHeader.vue';
import SectionHeading from '../components/SectionHeading.vue';
import { useProfile } from '../composables/useProfile';
import { slugify } from '../lib/format';

const props = defineProps({
    softSkills: { type: Array, required: true },
});

const { profile, fill } = useProfile();

/** Soft skills grouped as configured in profile.soft_skill_groups; the rest go to "More". */
const groups = computed(() => {
    const config = profile.value.soft_skill_groups ?? {};
    const used = new Set();
    const result = Object.entries(config).map(([name, members]) => {
        const skills = members
            .map((member) => props.softSkills.find((skill) => skill.name.toLowerCase() === String(member).toLowerCase()))
            .filter(Boolean);
        skills.forEach((skill) => used.add(skill.id));

        return { name, skills };
    });
    const rest = props.softSkills.filter((skill) => !used.has(skill.id));

    if (rest.length) {
        result.push({ name: result.length ? 'More' : 'Soft skills', skills: rest });
    }

    return result.filter((group) => group.skills.length);
});

const steps = computed(() => profile.value.working_model ?? []);
</script>

<template>
    <div class="page page--soft-skills">
        <Head title="How I work" />
        <PageHeader
            tag="How I work · Soft skills"
            title="Leading engineers, partnering with design and product."
            :intro="fill(profile.page_intros.soft_skills)"
        />

        <div class="container">
            <section v-if="steps.length" class="section" aria-labelledby="flow-title">
                <SectionHeading id="flow-title" kicker="01 · Working model" title="From idea to release, together" />
                <ol class="flow">
                    <li v-for="(step, index) in steps" :key="step.phase" class="flow__step">
                        <span class="flow__number">{{ String(index + 1).padStart(2, '0') }} / {{ step.phase }}</span>
                        <h3 class="flow__title">{{ step.title }}</h3>
                        <p>{{ fill(step.text) }}</p>
                        <ChipList :items="step.people ?? []" label="People involved" variant="soft" />
                    </li>
                </ol>
            </section>

            <section v-if="groups.length" class="section" aria-labelledby="skills-title">
                <SectionHeading
                    id="skills-title"
                    :kicker="`${steps.length ? '02' : '01'} · Soft skills`"
                    title="The habits behind it"
                />
                <div class="card-grid card-grid--3">
                    <section
                        v-for="group in groups"
                        :key="group.name"
                        class="group"
                        :aria-labelledby="`group-${slugify(group.name)}`"
                    >
                        <h3 :id="`group-${slugify(group.name)}`" class="group__title">{{ group.name }}</h3>
                        <ul class="group__list">
                            <li v-for="skill in group.skills" :key="skill.id">
                                <b>{{ skill.name }}</b>
                                <span>{{ skill.description }}</span>
                            </li>
                        </ul>
                    </section>
                </div>
            </section>
        </div>
    </div>
</template>
