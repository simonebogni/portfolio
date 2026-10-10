<script setup lang="ts">
import { useProfile } from '@designs/bento/entities/profile';
import { BaseButton, BentoTile, Icon } from '@designs/bento/shared/ui';

/** The violet call-to-action card. Hidden when the profile has no contact link. */
withDefaults(defineProps<{ title?: string; span?: number; headingId?: string }>(), {
    title: 'Have a project in mind?',
    span: 12,
    headingId: 'contact-title',
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
