<script setup lang="ts">
import { pad2 } from '@core/shared/lib';
import { useBlueprintProfile } from '@designs/blueprint/entities/profile';
import { PageHeader } from '@designs/blueprint/shared/ui';
import { CompanyTimeline } from '@designs/blueprint/widgets/company-timeline';
import { CurrentRole } from '@designs/blueprint/widgets/current-role';
import { Foundations } from '@designs/blueprint/widgets/foundations';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { experienceTag } from '../model/tag';
import type { ExperienceProps } from '../model/types';

const props = defineProps<ExperienceProps>();

const { profile, fill } = useBlueprintProfile();
const hasCurrentRole = computed(() => Boolean(profile.value.current_role.title));

const tag = computed(() => experienceTag(props.companies, hasCurrentRole.value));

/** Section numbers: 01 is the current role when there is one. */
function number(index: number): string {
    return pad2(index + 1 + (hasCurrentRole.value ? 1 : 0));
}
</script>

<template>
    <div class="page page--experience">
        <Head title="Experience" />
        <PageHeader :tag="tag" title="From writing the code to leading the team that writes it." :intro="fill(profile.page_intros.experience)" />

        <div class="container">
            <CurrentRole />

            <CompanyTimeline
                v-for="(company, index) in companies"
                :key="company.id"
                :company="company"
                :number="number(index)"
            />

            <Foundations
                :institutes="institutes"
                :other-programs="otherPrograms"
                :certificates="certificates"
                :awards="awards"
                :number="number(companies.length)"
            />
        </div>
    </div>
</template>
