<script setup lang="ts">
import { useProfile } from '@core/entities/profile';
import type { ProjectCategory } from '@core/entities/project';
import type { KineticProfile } from '@designs/kinetic/entities/profile';
import { PageHeader } from '@designs/kinetic/shared/ui';
import { ProjectShowcase } from '@designs/kinetic/widgets/project-showcase';
import { Head } from '@inertiajs/vue3';

/** Props of the Portfolio page (PortfolioController). */
defineProps<{
    categories: ProjectCategory[];
}>();

const { profile } = useProfile<KineticProfile>();
</script>

<template>
    <div class="page page--portfolio container">
        <Head title="Portfolio" />
        <PageHeader title="Wo" accent="rk." :intro="profile.intros?.portfolio" size="2xl" layout="split" :ruled="false" />

        <ProjectShowcase :categories="categories" />
    </div>
</template>
