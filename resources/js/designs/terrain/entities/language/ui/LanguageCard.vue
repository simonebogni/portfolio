<script setup lang="ts">
import type { Language } from '@core/entities/language';
import { LeafRating, SurfaceCard } from '@designs/terrain/shared/ui';
import { languageLevel } from '../model/level';

/** A spoken language with its level in words and as a leaf rating. A list item. */
defineProps<{
    language: Language;
}>();
</script>

<template>
    <SurfaceCard as="li" class="language">
        <h3 class="language__name">{{ language.name }}</h3>
        <p class="language__level">{{ languageLevel(language) }}</p>
        <LeafRating
            class="language__rating"
            :value="Number(language.rating)"
            :label="`${language.name}: ${language.rating} out of 5`"
        />
    </SurfaceCard>
</template>
