<script setup>
import { useProfile } from '../composables/useProfile';
import BaseButton from './BaseButton.vue';
import BentoTile from './BentoTile.vue';
import Icon from './Icon.vue';

/** The violet call-to-action card. Hidden when the profile has no contact link. */
defineProps({
    title: { type: String, default: 'Have a project in mind?' },
    span: { type: Number, default: 12 },
    headingId: { type: String, default: 'contact-title' },
});

const { contact } = useProfile();
</script>

<template>
    <BentoTile v-if="contact" :span="span" tone="accent" padding="lg" class="contact" :aria-labelledby="headingId">
        <h2 :id="headingId" class="contact__title">{{ title }}</h2>
        <BaseButton :href="contact.href" variant="on-accent">
            <Icon :name="contact.icon" />
            {{ contact.label }}
        </BaseButton>
    </BentoTile>
</template>
