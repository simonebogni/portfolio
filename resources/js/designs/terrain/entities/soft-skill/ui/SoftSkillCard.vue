<script setup lang="ts">
import type { SoftSkill } from '@core/entities/soft-skill';
import { pad2 } from '@core/shared/lib';
import { SurfaceCard } from '@designs/terrain/shared/ui';

/**
 * A soft skill on a numbered leaf card. A list item. The first one is the featured, accent card;
 * every third card flips its leaf.
 */
defineProps<{
    skill: SoftSkill;
    index: number;
}>();
</script>

<template>
    <SurfaceCard
        as="li"
        :shape="index % 3 === 0 ? 'leaf-flip' : 'leaf'"
        :tone="index === 0 ? 'accent' : 'default'"
        class="soft-skill"
        :class="{ 'soft-skill--feature': index === 0 }"
    >
        <span class="leaf-badge" aria-hidden="true">{{ pad2(index + 1) }}</span>
        <h2 class="soft-skill__title">{{ skill.name }}</h2>
        <p class="soft-skill__text">{{ skill.description }}</p>
    </SurfaceCard>
</template>
