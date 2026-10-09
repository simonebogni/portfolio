<script setup>
import SiteFooter from '../components/SiteFooter.vue';
import SiteHeader from '../components/SiteHeader.vue';
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <SiteHeader />
        <main id="main" class="site-main" tabindex="-1">
            <slot />
        </main>
        <SiteFooter />
    </div>
</template>
