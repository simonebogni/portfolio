<script setup lang="ts">
import { SiteFooter } from '@designs/source/widgets/site-footer';
import { SiteHeader } from '@designs/source/widgets/site-header';
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <SiteHeader />
        <main id="main" class="site-main container" tabindex="-1">
            <slot></slot>
        </main>
        <SiteFooter />
    </div>
</template>
