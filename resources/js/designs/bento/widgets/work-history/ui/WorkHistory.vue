<script setup lang="ts">
import { formatPeriod } from '@core/shared/lib';
import type { Company } from '@core/entities/work';
import { useProfile } from '@designs/bento/entities/profile';
import { TimelineEntry } from '@designs/bento/entities/work';
import { BentoTile, TileHeading } from '@designs/bento/shared/ui';
import { computed } from 'vue';
import { currentRoleEntry, positionEntries } from '../model/entries';

/** The "Work" tile of the Experience page: the configured current role, then every position, newest first. */
const props = defineProps<{ companies: Company[] }>();

const { profile } = useProfile();

const currentRole = computed(() => currentRoleEntry(profile.value, props.companies));
const positions = computed(() => positionEntries(props.companies));
</script>

<template>
    <BentoTile v-if="positions.length || currentRole" :span="8" class="work" aria-labelledby="work-title">
        <TileHeading id="work-title">Work</TileHeading>
        <ol class="entries">
            <TimelineEntry
                v-if="currentRole"
                :title="currentRole.title"
                :period="currentRole.period"
                :organisation="currentRole.organisation"
                current
            />
            <TimelineEntry
                v-for="position in positions"
                :key="position.id"
                :title="position.title"
                :period="formatPeriod(position)"
                :organisation="position.organisation"
                :html="position.descriptionHtml"
                :tags="position.tags"
                :current="position.current"
            />
        </ol>
    </BentoTile>
</template>
