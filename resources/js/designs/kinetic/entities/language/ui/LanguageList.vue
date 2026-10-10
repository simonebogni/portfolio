<script setup lang="ts">
import type { Language } from '@core/entities/language';
import { RatingBlocks } from '@designs/kinetic/shared/ui';
import { languageLevel } from '../model/level';

/** The spoken languages as square cards: name, level and a block rating. */
defineProps<{
    languages: readonly Language[];
}>();
</script>

<template>
    <ul class="language-grid plain-list">
        <li v-for="language in languages" :key="language.id" class="language-card">
            <h3 class="language-card__name display">{{ language.name }}</h3>
            <p class="language-card__level">{{ languageLevel(language) }}</p>
            <RatingBlocks :value="language.rating" />
        </li>
    </ul>
</template>
