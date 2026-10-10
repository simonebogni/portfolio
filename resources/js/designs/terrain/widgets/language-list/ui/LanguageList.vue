<script setup lang="ts">
import type { Language } from '@core/entities/language';
import { LanguageCard } from '@designs/terrain/entities/language';
import { SectionHeading } from '@designs/terrain/shared/ui';

/** "Languages I speak": one card per language. */
defineProps<{
    languages: Language[];
}>();
</script>

<template>
    <section class="page-section" aria-labelledby="languages-title">
        <SectionHeading id="languages-title" eyebrow="Communication" title="Languages I speak" />
        <ul class="grid grid--2 plain-list">
            <LanguageCard v-for="language in languages" :key="language.id" :language="language" />
        </ul>
    </section>
</template>
