<script setup lang="ts">
import type { Award } from '@core/entities/award';
import type { Certificate } from '@core/entities/certificate';
import type { Institute, Program } from '@core/entities/education';
import { formatYear } from '@core/shared/lib';
import { BpIcon, SectionHeading } from '@designs/blueprint/shared/ui';
import { computed } from 'vue';

/** "Foundations": education and online courses, awards, and certificates as cards. */
const props = defineProps<{
    institutes: readonly Institute[];
    otherPrograms: readonly Program[];
    certificates: readonly Certificate[];
    awards: readonly Award[];
    /** Section number, e.g. "04". */
    number: string;
}>();

const hasFoundations = computed(
    () => props.institutes.length || props.otherPrograms.length || props.awards.length || props.certificates.length,
);
</script>

<template>
    <section v-if="hasFoundations" class="section" aria-labelledby="edu-title">
        <SectionHeading
            id="edu-title"
            :kicker="`${number} · Foundations`"
            title="Education, awards & certifications"
        />
        <div class="card-grid card-grid--3">
            <article v-if="institutes.length || otherPrograms.length" class="card">
                <span class="kicker">Education</span>
                <template v-for="institute in institutes" :key="institute.id">
                    <div v-for="program in institute.programs" :key="program.id" class="card__block">
                        <h3 class="card__title">{{ program.name }}</h3>
                        <p class="card__text">{{ institute.name }}<template v-if="program.period"> · {{ program.period }}</template></p>
                    </div>
                </template>
                <template v-if="otherPrograms.length">
                    <h3 class="card__subtitle">Online courses</h3>
                    <ul class="line-list">
                        <li v-for="program in otherPrograms" :key="program.id">
                            <span>{{ program.name }}</span>
                            <span class="line-list__meta">{{ program.onlinePlatform || program.institute }}</span>
                        </li>
                    </ul>
                </template>
            </article>
            <article v-for="award in awards" :key="award.id" class="card">
                <p v-if="award.issueDate" class="card__big">{{ formatYear(award.issueDate) }}</p>
                <h3 class="card__title">{{ award.title }}</h3>
                <p v-if="award.subtitle" class="card__text">{{ award.subtitle }}</p>
                <p v-if="award.description" class="card__text">{{ award.description }}</p>
            </article>
            <article v-if="certificates.length" class="card">
                <span class="kicker">Certifications</span>
                <h3 class="card__title">{{ certificates.length }} certificates</h3>
                <ul class="line-list">
                    <li v-for="certificate in certificates" :key="certificate.id">
                        <span>
                            {{ certificate.title }}
                            <span class="line-list__meta">{{ certificate.issuedBy }}<template v-if="certificate.issueDate"> · {{ formatYear(certificate.issueDate) }}</template></span>
                        </span>
                        <a
                            v-if="certificate.url"
                            class="line-list__link"
                            :href="certificate.url"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            View<span class="visually-hidden"> {{ certificate.title }} certificate (opens in a new tab)</span>
                            <BpIcon name="external" :size="16" />
                        </a>
                    </li>
                </ul>
            </article>
        </div>
    </section>
</template>
