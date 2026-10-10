<script setup lang="ts">
import { SiteFooter } from '@designs/bento/widgets/site-footer';
import { SiteHeader } from '@designs/bento/widgets/site-header';
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <SiteHeader />
        <main id="main" class="wrap site-main" tabindex="-1">
            <slot></slot>
        </main>
        <SiteFooter />
    </div>
</template>
