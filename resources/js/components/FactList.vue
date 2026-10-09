<script setup>
/** "At a glance" box: a heavy rule, a small heading and a description list of label/value pairs. */
defineProps({
    id: { type: String, required: true },
    title: { type: String, required: true },
    items: { type: Array, required: true },
});
</script>

<template>
    <aside class="fact-list" :aria-labelledby="id">
        <h2 :id="id" class="fact-list__title">{{ title }}</h2>
        <dl class="fact-list__items">
            <div v-for="item in items" :key="item.label" class="fact-list__row">
                <dt>{{ item.label }}</dt>
                <dd>{{ item.value }}</dd>
            </div>
        </dl>
        <slot />
    </aside>
</template>
