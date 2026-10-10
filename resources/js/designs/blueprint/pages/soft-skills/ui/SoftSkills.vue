<script setup lang="ts">
import type { SoftSkill } from '@core/entities/soft-skill';
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { groupSoftSkills } from '@designs/blueprint/entities/soft-skill';
import { PageHeader } from '@designs/blueprint/shared/ui';
import { SoftSkillGroups } from '@designs/blueprint/widgets/soft-skill-groups';
import { WorkingModel } from '@designs/blueprint/widgets/working-model';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    softSkills: SoftSkill[];
}>();

const { profile, fill } = useBlueprintProfile();

/** Soft skills grouped as configured in profile.soft_skill_groups; the rest go to "More". */
const groups = computed(() => groupSoftSkills(props.softSkills, profile.value.soft_skill_groups ?? {}));

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
            <WorkingModel :steps="steps" />
            <SoftSkillGroups :groups="groups" :number="steps.length ? '02' : '01'" />
        </div>
    </div>
</template>
