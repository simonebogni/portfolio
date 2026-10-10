<script setup lang="ts">
import type { CurrentRole } from '@core/entities/profile';
import { BaseCard, TimelineEntry, TimelineList } from '@designs/source/shared/ui';

/** The current role from config/profile.php, drawn like a company card with one current position. */
withDefaults(defineProps<{ role: CurrentRole; location?: string | null }>(), { location: null });
</script>

<template>
    <BaseCard as="article" padding="lg" class="company" aria-labelledby="current-role-title">
        <div class="company__head">
            <h3 id="current-role-title" class="company__name">{{ role.company }}</h3>
            <span v-if="location" class="company__where">{{ location }}</span>
        </div>
        <TimelineList>
            <TimelineEntry :title="role.title" :start-date="role.since" current :period="role.since ? null : 'Current role'">
                <p v-if="role.team_size" class="timeline-entry__body">Leading a team of {{ role.team_size }}.</p>
            </TimelineEntry>
        </TimelineList>
    </BaseCard>
</template>
