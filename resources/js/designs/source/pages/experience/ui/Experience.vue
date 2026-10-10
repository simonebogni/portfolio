<script setup lang="ts">
import { AwardCard } from '@designs/source/entities/award';
import { CertificateCard } from '@designs/source/entities/certificate';
import { EducationCard, OnlineProgramsCard } from '@designs/source/entities/education';
import { firstName, useSourceProfile } from '@designs/source/entities/profile';
import { CompanyCard, CurrentRoleCard } from '@designs/source/entities/work';
import { PageHeader, SectionHeading } from '@designs/source/shared/ui';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { issuersOf, unlistedCurrentRole } from '../model/experience';
import type { ExperienceProps } from '../model/types';

const props = defineProps<ExperienceProps>();

const { profile } = useSourceProfile();
const eyebrow = computed(() => `$ git log --author="${firstName(profile.value.name).toLowerCase()}"`);

const currentRole = computed(() => unlistedCurrentRole(profile.value.current_role, props.companies));
const issuers = computed(() => issuersOf(props.certificates));
</script>

<template>
    <div class="page page-experience">
        <Head title="Experience" />
        <PageHeader :eyebrow="eyebrow" title="Experience" :intro="profile.intros?.experience" />

        <section class="block" aria-labelledby="work-title">
            <SectionHeading id="work-title" title="Work" comment="most recent first" />

            <CurrentRoleCard v-if="currentRole" :role="currentRole" :location="profile.location" />

            <CompanyCard v-for="company in companies" :key="company.id" :company="company" />
        </section>

        <section v-if="institutes.length || otherPrograms.length" class="block" aria-labelledby="education-title">
            <SectionHeading id="education-title" title="Education" comment="formal + self-taught" />
            <div class="card-grid card-grid--2">
                <template v-for="institute in institutes" :key="institute.id">
                    <EducationCard v-for="program in institute.programs" :key="program.id" :program="program" :institute="institute.name" />
                </template>
                <OnlineProgramsCard v-if="otherPrograms.length" :programs="otherPrograms" />
            </div>
        </section>

        <section v-if="certificates.length" class="block" aria-labelledby="certificates-title">
            <SectionHeading id="certificates-title" title="Certifications" :comment="issuers || null" />
            <ul class="card-grid card-grid--3 bare-list">
                <CertificateCard v-for="certificate in certificates" :key="certificate.id" :certificate="certificate" />
            </ul>
        </section>

        <section v-if="awards.length" aria-labelledby="awards-title">
            <SectionHeading id="awards-title" title="Awards" />
            <AwardCard v-for="award in awards" :key="award.id" :award="award" />
        </section>
    </div>
</template>
