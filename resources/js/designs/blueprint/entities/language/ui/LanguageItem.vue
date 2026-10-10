<script setup lang="ts">
import type { Language } from '@core/entities/language';
import { languageLevel } from '../model/level';

/** A spoken language and its level. */
defineProps<{
    language: Language;
}>();
</script>

<template>
    <li class="languages__item">
        <b>{{ language.name }}</b>
        <span>{{ languageLevel(language) }}</span>
    </li>
</template>
