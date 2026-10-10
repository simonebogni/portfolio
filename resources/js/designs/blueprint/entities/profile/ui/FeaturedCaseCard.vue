<script setup lang="ts">
import { CaseCard, TextLink } from '@designs/blueprint/shared/ui';
import type { FeaturedCaseStudy } from '../model/featured';

/** The leadership case study, first in the case study list, in the draft style until filled in. */
defineProps<{
    study: FeaturedCaseStudy;
}>();
</script>

<template>
    <CaseCard
        kind="Leadership · Current role"
        :title="study.title"
        :summary="study.summary"
        :meta="study.meta"
        draft
    >
        <template v-if="study.url" #actions>
            <TextLink :href="study.url" :context="study.title">Read the case study</TextLink>
        </template>
    </CaseCard>
</template>
