<script setup lang="ts">
import { FilterGroup, type FilterChoice } from '@designs/blueprint/shared/ui';

/** The case study filter buttons. */
defineProps<{
    options: readonly FilterChoice[];
}>();

const selected = defineModel<string>({ required: true });
</script>

<template>
    <FilterGroup v-model="selected" :options="options" label="Filter case studies" />
</template>
