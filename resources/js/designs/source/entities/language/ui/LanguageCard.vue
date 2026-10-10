<script setup lang="ts">
import type { Language } from '@core/entities/language';
import { BaseCard, RatingBar } from '@designs/source/shared/ui';

/** A spoken language: its level in words, as a bar, and its certificate. */
defineProps<{ language: Language }>();
</script>

<template>
    <BaseCard as="li" class="language">
        <h3 class="language__name">{{ language.name }}</h3>
        <p class="language__level">{{ language.isNative ? 'Native' : language.ratingMeaning }}</p>
        <RatingBar :value="language.rating" />
        <p v-if="language.certificateLevel" class="language__cert">
            <span class="visually-hidden">Certificate: </span>{{ language.certificateLevel }}
        </p>
    </BaseCard>
</template>
