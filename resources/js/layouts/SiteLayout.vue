<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import SiteFooter from '../components/SiteFooter.vue';
import SiteHeader from '../components/SiteHeader.vue';

const page = usePage();
const profile = computed(() => page.props.profile);
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <SiteHeader :name="profile.name" />
        <main id="main" class="wrap site-main" tabindex="-1">
            <slot />
        </main>
        <SiteFooter :profile="profile" />
    </div>
</template>
