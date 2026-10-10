<script setup lang="ts">
import { degreesOf } from '@designs/terrain/entities/education';
import { useTerrainProfile } from '@designs/terrain/entities/profile';
import { currentRoleStop, trailPositions } from '@designs/terrain/entities/work';
import { PageHeader } from '@designs/terrain/shared/ui';
import { CertificateList } from '@designs/terrain/widgets/certificate-list';
import { CourseList } from '@designs/terrain/widgets/course-list';
import { ExperienceTrail } from '@designs/terrain/widgets/experience-trail';
import { Milestones } from '@designs/terrain/widgets/milestones';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import type { ExperienceProps } from '../model/props';

const props = defineProps<ExperienceProps>();

const { profile } = useTerrainProfile();

/** Every work position, newest first, with its company. */
const positions = computed(() => trailPositions(props.companies));

/** The current role from config/profile.php, shown first unless a position is already marked current. */
const currentRole = computed(() => currentRoleStop(profile.value.current_role, profile.value.location, positions.value));

const degrees = computed(() => degreesOf(props.institutes));
</script>

<template>
    <div class="page page-experience">
        <Head title="Experience" />
        <PageHeader
            eyebrow="The path so far"
            title="Experience"
            intro="Where I’ve worked, what I’ve studied and the certifications I’ve earned along the way."
        />

        <ExperienceTrail v-if="positions.length || currentRole" :positions="positions" :current-role="currentRole" />

        <Milestones v-if="degrees.length || awards.length" :degrees="degrees" :awards="awards" />

        <CourseList v-if="otherPrograms.length" :programs="otherPrograms" />

        <CertificateList v-if="certificates.length" :certificates="certificates" />
    </div>
</template>
