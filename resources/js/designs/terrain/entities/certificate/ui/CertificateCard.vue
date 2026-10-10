<script setup lang="ts">
import type { Certificate } from '@core/entities/certificate';
import { formatMonthYear } from '@core/shared/lib';
import { BaseIcon, SurfaceCard } from '@designs/terrain/shared/ui';

/** A certificate with its date and a link to the credential. A list item. */
defineProps<{
    certificate: Certificate;
}>();
</script>

<template>
    <SurfaceCard as="li" class="certificate">
        <div>
            <h3 class="certificate__title">{{ certificate.title }}</h3>
            <p v-if="certificate.issueDate" class="certificate__date">{{ formatMonthYear(certificate.issueDate) }}</p>
        </div>
        <a v-if="certificate.url" class="text-link" :href="certificate.url" target="_blank" rel="noopener noreferrer">
            View<span class="visually-hidden"> the {{ certificate.title }} certificate (opens in a new tab)</span>
            <BaseIcon name="external" :size="16" />
        </a>
    </SurfaceCard>
</template>
