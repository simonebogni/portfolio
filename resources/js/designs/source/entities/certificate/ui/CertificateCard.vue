<script setup lang="ts">
import type { Certificate } from '@core/entities/certificate';
import { formatMonthYear } from '@core/shared/lib';
import { BaseCard, TextLink } from '@designs/source/shared/ui';

/** A certificate: date, title, description and a link to it. */
defineProps<{ certificate: Certificate }>();
</script>

<template>
    <BaseCard as="li" class="certificate">
        <div>
            <span v-if="certificate.issueDate" class="when">
                <time :datetime="certificate.issueDate">{{ formatMonthYear(certificate.issueDate) }}</time>
            </span>
            <h3 class="card-title">{{ certificate.title }}</h3>
            <p v-if="certificate.description" class="card-text card-text--small">{{ certificate.description }}</p>
        </div>
        <TextLink v-if="certificate.url" :href="certificate.url" :context="certificate.title">View certificate</TextLink>
    </BaseCard>
</template>
