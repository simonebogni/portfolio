<script setup lang="ts">
import { SiteFooter } from '@designs/blueprint/widgets/site-footer';
import { SiteHeader } from '@designs/blueprint/widgets/site-header';
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <SiteHeader />
        <main id="main" tabindex="-1">
            <slot></slot>
        </main>
        <SiteFooter />
    </div>
</template>
