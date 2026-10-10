<script setup lang="ts">
import type { Language } from '@core/entities/language';
import { LanguageItem } from '@designs/blueprint/entities/language';
import { SectionHeading } from '@designs/blueprint/shared/ui';

/** "Communication": the spoken languages and their levels. */
defineProps<{
    languages: readonly Language[];
}>();
</script>

<template>
    <section v-if="languages.length" class="section" aria-labelledby="langs-title">
        <SectionHeading id="langs-title" kicker="03 · Communication" title="Languages" />
        <ul class="languages">
            <LanguageItem v-for="language in languages" :key="language.id" :language="language" />
        </ul>
    </section>
</template>
