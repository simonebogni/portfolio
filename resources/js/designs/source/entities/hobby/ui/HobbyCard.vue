<script setup lang="ts">
import type { Hobby } from '@core/entities/hobby';
import { slugify } from '@core/shared/lib';
import { BaseCard } from '@designs/source/shared/ui';

/** A hobby: photo, its "file name" and description. */
defineProps<{ hobby: Hobby }>();
</script>

<template>
    <BaseCard as="li" padding="none" class="hobby">
        <!-- Decorative: the heading below names the picture's subject. -->
        <img v-if="hobby.coverImgUrl" class="hobby__photo" :src="hobby.coverImgUrl" alt="" width="400" height="240" loading="lazy" decoding="async" />
        <div class="hobby__body">
            <span class="hobby__file" aria-hidden="true">{{ slugify(hobby.title) }}.md</span>
            <h2 class="hobby__title">{{ hobby.title }}</h2>
            <p class="card-text">{{ hobby.description }}</p>
        </div>
    </BaseCard>
</template>
