<script setup lang="ts">
import { slugify } from '@core/shared/lib';
import type { SoftSkillGroup } from '../model/groups';

/** A group of soft skills: the group name on an inverted band, then each skill and its description. */
defineProps<{
    group: SoftSkillGroup;
}>();
</script>

<template>
    <section class="group" :aria-labelledby="`group-${slugify(group.name)}`">
        <h3 :id="`group-${slugify(group.name)}`" class="group__title">{{ group.name }}</h3>
        <ul class="group__list">
            <li v-for="skill in group.skills" :key="skill.id">
                <b>{{ skill.name }}</b>
                <span>{{ skill.description }}</span>
            </li>
        </ul>
    </section>
</template>
