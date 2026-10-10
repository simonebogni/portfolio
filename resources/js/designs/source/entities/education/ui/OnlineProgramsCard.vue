<script setup lang="ts">
import type { Program } from '@core/entities/education';
import { BaseCard } from '@designs/source/shared/ui';

/** Online programmes outside an institute, listed in one card. */
defineProps<{ programs: readonly Program[] }>();
</script>

<template>
    <BaseCard as="article" class="education">
        <span class="when">Online programmes</span>
        <h3 class="card-title">Continuous learning</h3>
        <ul class="programs bare-list">
            <li v-for="program in programs" :key="program.id">
                {{ program.name }}
                <span v-if="program.onlinePlatform || program.institute" class="programs__where">
                    · {{ [program.institute, program.onlinePlatform].filter(Boolean).join(', ') }}
                </span>
            </li>
        </ul>
    </BaseCard>
</template>
