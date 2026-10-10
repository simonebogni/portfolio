<script setup lang="ts">
import type { Award } from '@core/entities/award';
import { formatYear } from '@core/shared/lib';
import { AppIcon, BaseCard, ChipList } from '@designs/source/shared/ui';

/** An award with a trophy icon, its year, description and tags. */
defineProps<{ award: Award }>();
</script>

<template>
    <BaseCard as="article" class="award" :aria-labelledby="`award-${award.id}`">
        <div class="award__icon"><AppIcon name="trophy" :size="30" /></div>
        <div>
            <span class="when">
                <time v-if="award.issueDate" :datetime="award.issueDate">{{ formatYear(award.issueDate) }}</time>
            </span>
            <h3 :id="`award-${award.id}`" class="card-title">{{ award.title }}</h3>
            <p v-if="award.subtitle" class="card-text">{{ award.subtitle }}</p>
            <p v-if="award.description" class="award__description">{{ award.description }}</p>
            <ChipList :items="award.tags" />
        </div>
    </BaseCard>
</template>
