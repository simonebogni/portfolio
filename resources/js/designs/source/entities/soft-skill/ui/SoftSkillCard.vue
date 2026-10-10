<script setup lang="ts">
import type { SoftSkill } from '@core/entities/soft-skill';
import { pad2 } from '@core/shared/lib';
import { BaseCard } from '@designs/source/shared/ui';

/** A soft skill with its number in the list ("01", "02"…) as a badge. */
defineProps<{ skill: SoftSkill; number: number }>();
</script>

<template>
    <BaseCard as="li" padding="lg" class="soft-skill">
        <span class="badge" aria-hidden="true">{{ pad2(number) }}</span>
        <div>
            <h2 class="soft-skill__name">{{ skill.name }}</h2>
            <p class="card-text">{{ skill.description }}</p>
        </div>
    </BaseCard>
</template>
