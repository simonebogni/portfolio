<script setup lang="ts">
import type { Certificate } from '@core/entities/certificate';
import { CertificateCard, certificateIssuer } from '@designs/terrain/entities/certificate';
import { SectionHeading } from '@designs/terrain/shared/ui';
import { computed } from 'vue';

/** "Certifications", with the issuer as eyebrow when they all share one. */
const props = defineProps<{
    certificates: Certificate[];
}>();

const issuer = computed(() => certificateIssuer(props.certificates));
</script>

<template>
    <section class="page-section" aria-labelledby="certificates-title">
        <SectionHeading id="certificates-title" :eyebrow="issuer" title="Certifications" />
        <ul class="grid grid--certs plain-list">
            <CertificateCard v-for="certificate in certificates" :key="certificate.id" :certificate="certificate" />
        </ul>
    </section>
</template>
