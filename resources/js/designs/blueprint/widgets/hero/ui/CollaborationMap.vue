<script setup lang="ts">
import type { CollaborationPartner } from '@designs/blueprint/entities/profile';
import { computed } from 'vue';

/**
 * "How I work" diagram: the partners on top, the lead in the middle, the team
 * below (one dot per developer). The drawing is decorative; `description`
 * gives screen readers the same information in a sentence.
 */
const props = withDefaults(
    defineProps<{
        partners: readonly CollaborationPartner[];
        leadName: string;
        leadTitle: string;
        leadFocus?: string;
        teamSize?: number;
        portrait?: string;
    }>(),
    { leadFocus: '', teamSize: 0, portrait: '' },
);

const dots = computed(() => Math.max(0, Math.min(props.teamSize, 60)));
const columns = computed(() => Math.min(Math.max(dots.value, 1), 15));
const firstName = computed(() => props.leadName.split(' ')[0]);
const description = computed(() => {
    const partners = props.partners.map((partner) => partner.name.toLowerCase()).join(' and ');
    const team = props.teamSize > 0 ? `a team of ${props.teamSize} developers` : 'the engineering team';

    return `${firstName.value} sits between ${partners} on one side, and ${team} on the other, translating needs into technical direction.`;
});
</script>

<template>
    <figure class="map" aria-labelledby="map-caption">
        <figcaption class="map__header">
            <span id="map-caption">How I work</span>
            <span aria-hidden="true">fig. 01</span>
        </figcaption>
        <p class="visually-hidden">{{ description }}</p>
        <div aria-hidden="true">
            <div class="map__row" :style="{ '--map-columns': partners.length }">
                <div v-for="partner in partners" :key="partner.name" class="map__node">
                    <b>{{ partner.name }}</b><span>{{ partner.focus }}</span>
                </div>
            </div>
            <div class="map__wire" :style="{ '--map-columns': partners.length }"><i v-for="partner in partners" :key="partner.name"></i></div>
            <div class="map__hub">
                <img v-if="portrait" :src="portrait" alt="" width="52" height="52" />
                <div><b>{{ firstName }} · {{ leadTitle }}</b><span>{{ leadFocus }}</span></div>
            </div>
            <template v-if="teamSize > 0">
                <div class="map__wire map__wire--single"><i></i></div>
                <div class="map__team">
                    <b>Engineering team · {{ teamSize }} developers</b>
                    <div class="map__dots" :style="{ '--map-dots': columns }"><i v-for="n in dots" :key="n"></i></div>
                </div>
            </template>
        </div>
    </figure>
</template>
